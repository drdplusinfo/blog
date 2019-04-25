<?php declare(strict_types=1);

namespace TomasVotruba\Website\Posts\Year2017\Ast\Printer;

use PhpParser\Lexer\Emulative;
use PhpParser\NodeTraverser;
use PhpParser\NodeVisitor;
use PhpParser\NodeVisitor\CloningVisitor;
use PhpParser\Parser\Php7;
use PhpParser\PrettyPrinter\Standard;

final class FormatPreservingPrinter
{
    public function traverseWithVisitorAndPrint(NodeVisitor $nodeVisitor, string $code): string
    {
        $lexer = $this->createLexer();

        $parser = new Php7($lexer);
        $traverser = new NodeTraverser();
        $traverser->addVisitor(new CloningVisitor());

        $oldStmts = $parser->parse($code);
        $oldTokens = $lexer->getTokens();

        $newStmts = $traverser->traverse($oldStmts);

        // our code start

        $nodeTraverser = new NodeTraverser();
        $nodeTraverser->addVisitor($nodeVisitor);

        $traversedNodes = $nodeTraverser->traverse($newStmts);
        $newStmts = $traversedNodes;

        // our code end

        return (new Standard())->printFormatPreserving($newStmts, $oldStmts, $oldTokens);
    }

    private function createLexer(): Emulative
    {
        return new Emulative([
            'usedAttributes' => ['comments', 'startLine', 'endLine', 'startTokenPos', 'endTokenPos'],
        ]);
    }
}
