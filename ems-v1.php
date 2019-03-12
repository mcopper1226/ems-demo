<html>
    <head>
        <title>
            Authentication
        </title>

        <script src="https://code.jquery.com/jquery-3.2.1.min.js" crossorigin="anonymous"></script>
            </head>
    <body>
        <h3 class="text-center">Authentication</h3>
        <div class="container">

                <button type="button" class="btn btn-primary center-block" onclick="getTest()">Get Events</button>

            <div id="token-display">
            </div>
        </div>
        </br>
        </br>
        <div class="container">
          <h3 class="text-center">List</h3>
            <div id="list">
            </div>
        </div>
        <div class="container">
          <h3>UDFs</h3>
          <button type="button" class="btn btn-primary center-block" onclick="testUDF()">Get Fields</button>
        </div>
        <div class="container">
          <h3>UDFs for single event</h3>
          <button type="button" class="btn btn-primary center-block" onclick="udf()">Get Fields</button>
        </div>
        <div class="container">
          <h3>Query by UDF</h3>
          <button type="button" class="btn btn-primary center-block" onclick="udfQuery()">Get Fields</button>
        </div>
        <script type="text/javascript">
            var myToken;
            var xhttp = new XMLHttpRequest();
            var data={"clientId": "p6D2aFlORVWPYOHtgMZ8Eg", "secret": "Y9ZdE9BqMinxnXUzc5cF58UE8BWLBmRIs-GtkAPiuCs"};
            xhttp.onreadystatechange = function() {
                if (xhttp.readyState==4) {
                    var response = JSON.parse(xhttp.responseText);
                    var token = response.clientToken;

                    myToken = token;
                    return myToken;

                }
            };
            xhttp.open("POST", "https://mcintire.test.emscloudservice.com/platform/api/v1/clientauthentication", true);
            xhttp.setRequestHeader("Content-type", 'application/json; charset=UTF-8');
            xhttp.send(JSON.stringify(data));


            function getTest(){
                var date = new Date();
                var dateString = date.toISOString();
                console.log(dateString);
                var xhttp = new XMLHttpRequest();
                var params = "pageSize=100&minReserveStartTime=" + dateString + "&eventTypeDisplayOnWeb=true";
                console.log(params);
                xhttp.onreadystatechange = function() {
                    if (xhttp.readyState==4 && xhttp.status==200) {
                        var response = JSON.parse(xhttp.responseText);
                        var results = response.results;
                        var count = response.pageCount;
                        var ul=document.createElement("ul");
                        for(var i=0;i<results.length;i++) {
                          var li=document.createElement("li");
                          li.appendChild(document.createTextNode(results[i].eventName));
                          ul.appendChild(li);
                        }
                      console.log('Total Pages ' + count);
                      console.log(results);
                    }
                     document.getElementById("list").appendChild(ul);
                };
                xhttp.open("GET", "https://mcintire.test.emscloudservice.com/platform/api/v1/bookings?" + params, true);
                xhttp.setRequestHeader("x-ems-api-token", myToken);
                xhttp.send();
            }

            function udf(id){

                var xhttp = new XMLHttpRequest();
                var params = "pageSize=100&minReserveStartTime=2019-02-24T18:22:10.338Z&eventTypeDisplayOnWeb=true";

                xhttp.onreadystatechange = function() {
                    if (xhttp.readyState==4 && xhttp.status==200) {
                        var response = JSON.parse(xhttp.responseText);
                          var results = response.results;
                      console.log(results);
                    }
                };
                xhttp.open("GET", "https://mcintire.test.emscloudservice.com/platform/api/v1//reservations/13641/userdefinedfields", true);
                xhttp.setRequestHeader("x-ems-api-token", myToken);
                xhttp.send();
            }
            function udfQuery(){

                var xhttp = new XMLHttpRequest();
                var params = "udf=8:12";

                xhttp.onreadystatechange = function() {
                    if (xhttp.readyState==4 && xhttp.status==200) {
                        var response = JSON.parse(xhttp.responseText);
                          var results = response.results;
                      console.log(results);
                    }
                };
                xhttp.open("GET", "https://mcintire.test.emscloudservice.com/platform/api/v1/reservations?udf=Alumni:Yes", true);
                xhttp.setRequestHeader("x-ems-api-token", myToken);
                xhttp.send();
            }

            function testUDF() {
              var xhttp = new XMLHttpRequest();
              xhttp.open('POST', 'https://mcintire.test.emscloudservice.com/platform/api/v1/reservations/actions/search/userdefinedfields', true);
              xhttp.setRequestHeader('x-ems-api-token', myToken);
              xhttp.setRequestHeader('Content-Type', 'application/json;charset=UTF-8');

              xhttp.onreadystatechange = function() {
                if (xhttp.readyState==4 && xhttp.status==200) {
                  var response = JSON.parse(xhttp.responseText);
                  var results = response.results;
                  var count = response.pageCount;
                  console.log(results);
                }
              };
              xhttp.send(JSON.stringify(
                {

"reservationIds": [
  13641,
  15613
]
}
              ));

            }


        </script>
    </body>
</html>
