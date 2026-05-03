.PHONY: run

MAKEFLAGS += --no-print-directory

run:
	docker compose up -d
	@PORT=$$(docker compose port hugo 1313 2>/dev/null | cut -d: -f2); \
	echo "Blog runs on http://localhost:$${PORT}"
