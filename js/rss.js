var placeholder = document.querySelector('.eventFeed');
if (placeholder) {
  var count = placeholder.dataset.count;
  var feed = placeholder.dataset.feed;
  var url = 'https://api.rss2json.com/v1/api.json?rss_url=' + feed + '&api_key=w6wessov1noch5ltrqs7fw83rjgridvg2ysdkykj&count=' + count;


  var oReq = new XMLHttpRequest(); //New request object
  oReq.onload = function() {
    var obj = JSON.parse(this.responseText);
    var allEvents = obj.items;
    formatEvents(allEvents);
  };
  oReq.open("get", url, true);

  oReq.send();

  function formatEvents(events) {
    var output = '';
    events.forEach(function(event) {

      let link = event.link;
      let title = event.title;
      let category = event.categories[0];
      let catLower = category.toLowerCase();
      let cat = catLower.split(" ");
      let catClass=cat[0];
      let ISOdate = event.pubDate;
      let rawDate = new Date(ISOdate);
      var date = rawDate.getDate();
      var month = rawDate.getMonth();
      var year = rawDate.getFullYear();
      var monthNames = [
        "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"
      ];
      var dateString = monthNames[month] + " " + date + ", " + year;
      var timeEnd = event.description.indexOf('-');
      var strLength = event.description.length;
  		var time = event.description.substring(0, timeEnd); // Extract just the URL
      var description = event.description.substring(timeEnd + 2, strLength);
      var locationEnd = description.indexOf(':');
      var descriptionLength = description.length;
      if (locationEnd >= 0) {
        var location = description.substring(0, locationEnd);
        var details = description.substring(locationEnd + 2, descriptionLength);
      } else {
        var location = description;
        var details = '';
      }
      console.log(time + location + details);
      output += '<a class="event ' + catClass + '" href="' + link + '"><div class="event-inner"><div class="event-content"><div class="event-content-inner"><h4>' + category + '</h4><h3>' + title + '</h3><div class="event-meta"><span class="event-date">' + dateString + '</span><span class="divider"></span><span class="event-time">' + time + '</span></div><div class="event-desc">' + details + '</div></div></div></div></a>'

      placeholder.innerHTML = output;

    });
    filterSelection("all"); 
  }
}



var filter = document.querySelectorAll('.filter');
for (var i = 0; i < filter.length; i++) {
  filter[i].addEventListener('click', function() {
    var selected = this.getAttribute('data-select');
    filterSelection(selected);
  })
}



function filterSelection(c) {
  var x, i;
  x = document.getElementsByClassName("event");
  if (c == "all") c = "";
  for (i = 0; i < x.length; i++) {
    w3RemoveClass(x[i], "show");
    if (x[i].className.indexOf(c) > -1) w3AddClass(x[i], "show");
  }
}

function w3AddClass(element, name) {
  var i, arr1, arr2;
  arr1 = element.className.split(" ");
  arr2 = name.split(" ");
  for (i = 0; i < arr2.length; i++) {
    if (arr1.indexOf(arr2[i]) == -1) {element.className += " " + arr2[i];}
  }
}

function w3RemoveClass(element, name) {
  var i, arr1, arr2;
  arr1 = element.className.split(" ");
  arr2 = name.split(" ");
  for (i = 0; i < arr2.length; i++) {
    while (arr1.indexOf(arr2[i]) > -1) {
      arr1.splice(arr1.indexOf(arr2[i]), 1);
    }
  }
  element.className = arr1.join(" ");
}
