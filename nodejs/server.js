/**
 * Created by kenlayug on 7/25/16.
 */
var app = require('express')();
var server = require('http').Server(app);
var io = require('socket.io')(server);
var redis = require('redis');

server.listen(8890);
io.on('connection', function (socket) {

    console.log("new client connected");
    var redisClient = redis.createClient();
    redisClient.subscribe('message');
    redisClient.subscribe('new-service-category');

    redisClient.on("message", function(channel, message) {
        console.log("mew message in queue "+ message + "channel");
        socket.emit(channel, message);
    });

    redisClient.on("new-service-category", function(channel, message){

        console.log('New Service Category Added.');
        var jsonData    =   JSON.stringify(message);
        socket.broadcast.emit(channel, jsonData);

    });

    socket.on('disconnect', function() {
        redisClient.quit();
    });

});