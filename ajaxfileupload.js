
// grab your file object from a file input
$('#fileInput').change(function () {
  sendFile(this.files[0]);
});
 
// can also be from a drag-from-desktop drop
$('dropZone')[0].ondrop = function (e) {
  e.preventDefault();
  sendFile(e.dataTransfer.files[0]);
};

function sendFile(files) {
     var data = new FormData();
     $.each(files, function(key, value)
     {
         data.append(key, value);
     });
	 console.log(data,data[0],data);
     $.ajax({
         type: 'post',
         url: '?name=' + files.name,
         data: data,
         success: function() {
                  // do something
         },
		  xhrFields: {
            // add listener to XMLHTTPRequest object directly for progress (jquery doesn't have this yet)
             onprogress: function(progress) {
             	console.log(progress);
                // calculate upload progress
                var percentage = Math.floor((progress.total / progress.totalSize) * 100);
                // log upload progress to console
                console.log('progress', percentage);
                if (percentage === 100) {
                   console.log('DONE!');
                }
             }
          },
          processData: false,
          contentType: false
    });
 }
  