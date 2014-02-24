var http = require("http");
var cheerio = require("cheerio");
var  fs = require("fs");
var iconv = require('iconv-lite');
var BufferHelper = require('bufferhelper');
var when = require('when');
var querystring = require("querystring");
// Utility function that downloads a URL and invokes
// callback with the data.
function download(url, callback) {
  http.get(url, function(res) {
    var buffer = new BufferHelper();
    res.on('data', function (data) {
      buffer.concat(data);
    });
    res.on("end", function() {
      var buf = buffer.toBuffer(),
          str = iconv.decode(buf,"utf-8");
      callback(str);
    });
  }).on("error", function() {
    callback(null);
  });
}
var urlArray = [
  {
    url:"http://www.zhihu.com/topic/19550429/top-answers",//电影
    fileName:"zhihu_movie.js",
  },
  {
    url:"http://www.zhihu.com/topic/19559052/top-answers",//足球
    fileName:"zhihu_football.js",
  },
  {
    url:"http://www.zhihu.com/topic/19651696/top-answers",//个人咨询
    fileName:"zhihu_person.js",
  },
  {
    url:"http://www.zhihu.com/topic/19550780/top-answers",//电子商务
    fileName:"zhihu_mall.js",
  },
  {
    url:"http://www.zhihu.com/topic/19551404/top-answers",//投资
    fileName:"zhihu_money.js",
  }
 ];
var fileNamePre = "zhihu_q_a",
    fileName,
    urlPre = "http://www.zhihu.com/topic/19569420/top-answers?page=",
    url,
    result = {},
    deferred = when.defer();
var getList = function(url,fileName){
     //console.log(fileName);
    download(url, function(data) {
  if (data) {
      //console.log(data);
      var $ = cheerio.load(data);
      $(".feed-item").each(function(i, item) {
        var itemObj = {};
        var href = $(item).find(".question_link").attr("href");
        var name = $(item).find(".question_link").text();
        var detailUrl = "http://www.zhihu.com" + href;    
        itemObj["title"] = name;
        itemObj["detail"] = detailUrl;  
        result["item" + i] = itemObj;
      });
       //console.log(fileName);
       deferred.resolve(fileName);
    }
  });
    return deferred.promise;
};
var getItem = function(item,fileName){
    var detailUrl = item["detail"],
        deferred = when.defer();
    download(detailUrl,function(data){
      var $ = cheerio.load(data);
      var des = $(".zm-item-title").remove("a").text();
      item["des"] = des;
      item["item-content"] = [];
     // item["item-content"] = $($(".zm-item-answer")[0]).html();
      $(".zm-item-answer").each(function(i,dom){
          item["item-content"].push($(dom).find(".zm-item-rich-text").html());
      });
      //console.log(fileName);
      deferred.resolve(fileName);
    });
    return deferred.promise;
};
var getDetail = function(fileName){
  console.log(fileName);
  var deferreds = [];
  for(var i in result){   
      deferreds.push(getItem(result[i],fileName));    
  }
  return deferreds;
};
var writeFile = function(fileName){
  //console.log(fileName);
  var content = querystring.stringify(result);
  // var options = {
  //   host:"localhost",
  //   path:"/yuyanfei/index.php",
  //   method:"POST"
  // };
  // var req = http.request(options,function(res){
  //     var buffer = new BufferHelper();
  //     res.on("data",function(data){
  //       buffer.concat(data);
  //     });
  //     res.on("end", function() {
  //     var buf = buffer.toBuffer(),
  //         str = iconv.decode(buf,"utf-8");
  //     console.log(str);
  //   })
  // });
  // req.write(content);
  // req.end();

  fs.writeFile(fileName,JSON.stringify(result));
  //fs.writeFile("zhihu_movie.js",content);

}
var arr = new Array(5),
    arrLen = arr.length;
for(var page = 1; page <= arrLen; page++){
  url = urlPre + page;
  fileName = fileNamePre + page + ".js"; 
  //console.log(url);
  //console.log(fileName);
  when.all(getList(url,fileName).then(getDetail)).then(writeFile);
}
