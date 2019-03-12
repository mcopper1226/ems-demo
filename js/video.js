var config = new KalturaConfiguration(771032);
  config.serviceUrl = 'https://www.kaltura.com';
  var client = new KalturaClient(config);
  // Note: this is meant only as a sample.
  // You should NEVER generate sessions on the client,
  // as this exposes your Admin Secret to users.
  // Instead, generate a session on the server and pass the
  // KS to the client.
  KalturaSessionService.start(
        "885b657c2c397f5f968ffefda8e5a33a",
        "mni7a@comm.virginia.edu",
        2,
        771032)
  .execute(client, function(success, ks) {
    if (!success || (ks.code && ks.message)) {
      console.log('Error starting session', success, ks);
    } else {
      client.setKs(ks);
      var filter = {objectType: "KalturaMediaEntryFilter"};
      filter.categoriesIdsMatchAnd = "68058291";
      var pager = {objectType: "KalturaFilterPager"};

      KalturaMediaService.listAction(filter, pager)
        .execute(client, function(success, results) {
          if (!success || (results && results.code && results.message)) {
            console.log('Kaltura Error', success, results);
          } else {
            test_r(results.objects);
          }
        });

    }
  });


   var content = $('#videoContainer');
   function test_r(res) {
     console.log(res);
    var output = '';
			$.each(res, function (k, item) {
				var entryID = item.id;
        var desc = item.description;
        var link = 'https://cdnapisec.kaltura.com/p/771032/sp/77103200/embedIframeJs/uiconf_id/38557412/partner_id/771032?iframeembed=true&amp;playerId=kplayer&amp;entry_id=' + entryID + '&amp;flashvars[autoPlay]=true';
        var thumbnail = 'http://cdn.kaltura.com/p/771032/thumbnail/entry_id/' + entryID + '/width/600/type/1/quality/100';
        var bgImage = 'background-image:url(' + thumbnail + ');';
        var title = item.name;
        output += '<div class="video-outer"><div class="video-inner"><a class="video-popup" href="' + link + '" style="' + bgImage + '">';
        output += '<svg style="width:100%;z-index:-10;opacity:0;display:block;" viewBox="0 0 16 9"><rect height="9" width="16" x="0" y="0"></rect></svg></a><h4>' + title + '</h4><p>' + desc + '</p></div></div>';
				return k;
			});
			content.html(output);
      var video = $('.video-popup').get();
      console.log('ready to popup');
      if (video.length > 0) {
        $('.video-popup').magnificPopup({
          type: 'iframe',
          iframe: {
            patterns: {
              dailymotion: {

                index: 'cdnapisec.dailymotion.com',

                id: function(url) {
                    var m = url.match(/^.+dailymotion.com\/(video|hub)\/([^_]+)[^#]*(#video=([^_&]+))?/);

                    return m[2];
                },

                src: 'https://www.dailymotion.com/embed/video/%id%'

              },
              kaltura: {
                index: 'kaltura.com',

                id: function(url) {
                    var m = url.match(/^.+entry_id=(([^?]+))[^#]/);
                    if (m !== null) {
                        if(m[4] !== undefined) {

                            return m[4];
                        }
                        return m[2];
                    }
                    return null;
                },
                src: 'https://cdnapisec.kaltura.com/p/771032/sp/77103200/embedIframeJs/uiconf_id/38557412/partner_id/771032?iframeembed=true&playerId=kplayer&entry_id=%id%'

              }
            }
          }
        });
      }
  }
