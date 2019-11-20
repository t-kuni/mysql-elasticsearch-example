# About

MySQLをElasticsearchに同期するサンプル

# 準備

max_map_countを引き上げないとElasticsearchが起動しない

```
docker-machine ssh default sudo sysctl -w vm.max_map_count=262144
```

# 起動

```
docker-compose up mysql phpmyadmin fluentd elasticsearch kibana
```

# PhpMyAdminを開く

```
http://192.168.99.100:8080
```

# Kibanaを開く

```
http://192.168.99.100:5601
```

# Start shell

```
docker-compose run --rm app-debug sh
```


# Reference

logstash: https://www.elastic.co/guide/en/logstash/current/introduction.html