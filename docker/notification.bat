cd ./notification
docker build -t g3t6/notification:1.0.0 .
docker run -p 5566:5566 g3t6/notification:1.0.0