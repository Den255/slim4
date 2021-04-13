include .env
init-db:
	echo "Start init"
	mkdir -p tmp
	cat docker/mysql/db-init.sql | sed "\
		s=@DB_USER@=${DB_USER}=g;\
		s=@DB_NAME@=${DB_NAME}=g;\
		s=@DB_PASSWORD@=${DB_PASSWORD}=g;\
	" > ./tmp/db-init.sql
	docker cp ./tmp/db-init.sql ${MYSQL_CN}:/opt/db-init.sql
	docker exec ${MYSQL_CN} mysql -uroot -p${MYSQL_ROOT_PASSWORD} -e "source /opt/db-init.sql"
up:
	echo "Start up"
	docker-compose up -d
down:
	echo "Start down"
	docker-compose down