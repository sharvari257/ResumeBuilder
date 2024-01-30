function displayPDF(id) {
    $.ajax({
      url: 'index.php', // Separate file for fetching PDF path
      type: 'POST',
      data: { id: id },
      success: function(response) {
        var pdfPath = response;
        $('#pdf-display').html('<iframe src="' + pdfPath + '" width="100%" height="500px"></iframe>');
      }
    });
  }
  