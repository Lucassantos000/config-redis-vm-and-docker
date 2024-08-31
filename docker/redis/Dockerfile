FROM ubuntu:latest

# Instalar pacotes básicos
RUN apt-get update && apt-get install -y \
    nano \
    redis-server \
    && rm -rf /var/lib/apt/lists/*

# Copiar arquivo de configuração do Redis
COPY redis.conf /etc/redis/redis.conf

# Configurar o Redis para iniciar automaticamente
RUN sed -i 's/^supervised no/supervised systemd/' /etc/redis/redis.conf \
    && sed -i 's/^dir \/var\/lib\/redis/dir \/data/' /etc/redis/redis.conf

# Criar o diretório de dados
RUN mkdir -p /data

# Expor a porta padrão do Redis
EXPOSE 6379

# Iniciar o serviço Redis
CMD ["redis-server", "/etc/redis/redis.conf"]
