jQuery.fn.tableToCSV = function() {

    var clean_text = function(text){
        text = text.replace(/"/g, '""');
        return '"'+text+'"';
    };

	$(this).each(function(){
			var table = $(this);
			var caption = $('#datepicker').val();
      caption = caption.replace(/"/g, '"-"');
			var title = [];
			var rows = [];

			$(this).find('.row').each(function(){
				var data = [];
				/*$(this).find('.header').each(function(){
                    var text = clean_text($(this).text());
					title.push(text);
        });*/
				$(this).find('.cell').each(function(){
                    var text = clean_text($(this).text());
					data.push(text);
					});
				data = data.join(",");
				rows.push(data);
				});
			title = title.join(",");
			rows = rows.join("\n");

			var csv = title + rows;
			var uri = 'data:text/csv;charset=utf-8,' + encodeURIComponent(csv);
			var download_link = document.createElement('a');
			download_link.href = uri;
			var ts = new Date().getTime();
			if(caption==""){
				download_link.download = ts+".csv";
			} else {
				download_link.download = caption+".csv";
			}
			document.body.appendChild(download_link);
			download_link.click();
			document.body.removeChild(download_link);
	});

};
