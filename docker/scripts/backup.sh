#!/bin/bash
# Script para backup do banco de dados e arquivos de upload

# Definir variáveis
TIMESTAMP=$(date +"%Y%m%d_%H%M%S")
BACKUP_DIR="/home/$(whoami)/backups"
MYSQL_USER="${DB_USERNAME}"
MYSQL_PASSWORD="${DB_PASSWORD}"
MYSQL_DATABASE="${DB_DATABASE}"

# Criar diretório de backup se não existir
mkdir -p $BACKUP_DIR

# Backup do banco de dados
echo "Iniciando backup do banco de dados..."
docker compose -f docker-compose.prod.yml exec -T db mysqldump -u$MYSQL_USER -p$MYSQL_PASSWORD $MYSQL_DATABASE | gzip > $BACKUP_DIR/db_backup_$TIMESTAMP.sql.gz
echo "Backup do banco de dados concluído: $BACKUP_DIR/db_backup_$TIMESTAMP.sql.gz"

# Backup dos arquivos de upload
echo "Iniciando backup dos arquivos de upload..."
docker compose -f docker-compose.prod.yml exec -T app tar -czf - -C /var/www/storage/app/public . > $BACKUP_DIR/uploads_backup_$TIMESTAMP.tar.gz
echo "Backup dos arquivos de upload concluído: $BACKUP_DIR/uploads_backup_$TIMESTAMP.tar.gz"

# Limpar backups antigos (manter apenas os últimos 7)
echo "Removendo backups antigos..."
ls -tp $BACKUP_DIR/db_backup_*.sql.gz | grep -v '/$' | tail -n +8 | xargs -I {} rm -- {}
ls -tp $BACKUP_DIR/uploads_backup_*.tar.gz | grep -v '/$' | tail -n +8 | xargs -I {} rm -- {}

echo "Processo de backup concluído com sucesso!"