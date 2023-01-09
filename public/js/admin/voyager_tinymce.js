
$(document).ready(function(){

  $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });

  tinymce.init({
    menubar: false,
    selector:'textarea.richTextBox-kravanh',
    skin: 'voyager',
    min_height: 400,
    resize: 'vertical',
    plugins: 'link, image, code, youtube, giphy, table, textcolor, lists',
    extended_valid_elements : 'input[id|name|value|type|class|style|required|placeholder|autocomplete|onclick]',
    file_browser_callback: function(field_name, url, type, win) {
     
      var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
      var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;
      var url_media = window.location.origin + '/admin/media-tinymce';
      ///console.log(window.location);
      console.log(url_media);
      tinyMCE.activeEditor.windowManager.open({
        file : url_media,
        title : 'KRAVANH Media Manager',
        width : x * 0.8,
        height : y * 0.8,
        resizable : "yes",
        close_previous : "no",
        buttons: [ {
          text: 'Close',
          onclick: 'close',
          window : win,
          input : field_name
      }]
    }, {
        oninsert: function(url) {
            win.document.getElementById(field_name).value = url; 
            //console.log(url);
        },
        onselect: function() {
            console.log("onselect");
        }
  
      });
      },
    toolbar: 'styleselect bold italic underline | forecolor backcolor | alignleft aligncenter alignright | bullist numlist outdent indent | link image table youtube giphy | code',
    convert_urls: false,
    image_caption: true,
    image_title: true
  });

});
