# Instalar Redis no linux ubuntu 

### 31/08/2024



<details>
  <summary>Vm Linux</summary>
  
  ### Atualizar os pacotes da vm

  #### Atualizar a lista dos os pacotes
  ```bash
  sudo apt update
  ```
  
  #### Atualizar os pacotes
  Atualiza pacotes instalados sem remover ou instalar pacotes adicionais. 
  ```bash
  sudo apt upgrade
  ```


  
  ### Instalar e Configurar o Redis

  #### Instalar o Redis-Server

  ```bash
  sudo apt install redis-server
  ```

  #### Configura o Redis para iniciar automaticamente
  Edite o arquivo de configuração do Redis:
  
  ```bash
  sudo nano /etc/redis/redis.conf
  ```

  #### Reiniciar o serviço Redis para aplicar as mudanças
  ```bash
  sudo systemctl restart redis.service
  ```

  #### Habilitar o Redis para iniciar automaticamente na inicialização do sistema
  ```bash
  sudo systemctl enable redis
  ```

  #### Verificar o status do Redis
  ```
  sudo systemctl status redis
  ```

  ---
  #### Desabilitar o Redis para não iniciar automaticamente na inicialização do sistema
  ```bash
  sudo systemctl disable redis
  ```
  ---
  #### Desinstalar o Redis e limpar as configurações
  <details>
  <summary>Desinstalar o Redis </summary>

  ##### Parar o Redis
  ```bash
  sudo systemctl stop redis
  ```
  ##### Desinstalar o Redis
  ```bash
  sudo apt remove --purge redis-server
  ```
  *: A opção --purge é usada para garantir que todos os arquivos de configuração associados ao pacote sejam removidos junto com ele. Isso inclui arquivos em diretórios como /etc/, que não seriam removidos apenas com o apt remove.* 

  ##### Remover arquivos de configuração restantes
  ```bash
  sudo rm -rf /etc/redis
  ```
  ##### Remover dados do Redis (opcional)
  ```bash
  sudo rm -rf /var/lib/redis
  ```


  </details>

</details>

<details>
  <summary>Docker</summary>
  

### Criar Dockerfile

Para criar um Dockerfile para o Redis, você pode usar uma imagem base do Ubuntu ou Alpine e instalar o Redis nele. Aqui está um exemplo de Dockerfile usando a imagem base do Ubuntu:

```Dockerfile
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
```


Lembre-se de ter um arquivo `redis.conf` no mesmo diretório do Dockerfile, contendo as configurações desejadas para o Redis.


</details>