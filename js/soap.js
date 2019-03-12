var placeholder = document.querySelector('.placeholder');
var oReq = new XMLHttpRequest(); //New request object
oReq.onload = function() {
    var obj = this.responseText;
    var list = JSON.parse(obj);
    var first = list[0];
    formatEvents(list);
};
oReq.open("get", "soaptest2.php", true);

oReq.send();


function formatEvents(events) {
  console.log(events); 
  var output = '';
  events.forEach(function(event) {

    let link = 'https://google.com';
    let id = event.EventID;
    let title = event.Title;
    let category = event.EventTypeName;
    if(typeof event.CustomFieldDescription2 === 'string') {
      var audience = event.CustomFieldDescription2;
    } else {
      var audience = 'all';
    }

    let date = event.EventDate;
    if(typeof event.Location === 'string') {
      var location = event.Location;
    } else {
      var location = '';
    }
    output += '<div class="event" data-audience="' + audience + '"><a class="event-inner" href="' + link + '"><div class="event-content"><div class="event-content-inner"><h4>' + category + '</h4><h3>' + title + '</h3><div class="event-meta"><span class="event-date">' + date + '</span><span class="event-location">' + location + '</span></div></div></div></a></div>'

    placeholder.innerHTML = output;

  });

}
