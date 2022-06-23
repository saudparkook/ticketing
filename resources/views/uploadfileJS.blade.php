
    <script>
        function uploadFiles() {

          var file =file_upload.files;
          if(file.length==0){
            alert("Please first choose or drop any file(s)...");
            return;
          }

          titleUploadfile.hidden=false;
          titleUploadfile.innerHTML="{{ __('message.UFJ.uploading') }} "+file[0].name;
          titleUploadfile.style.color="#000d83";
          btnloadfile.hidden=false;
          divfilechooser.hidden=true;
          var fd = new FormData();
          fd.append('_token',document.getElementsByName('_token')[0].value);
          fd.append('myfile',file_upload.files[0]);
          fd.append('folder','publicfile');
          file_upload.value="";

          ajaxfileuploader('{{ route("uploadfile") }}' , fd,responseFile);
        }
      //   function responseFile(filename,deleteLink,status){
        function responseFile(parametr,status){
             if(status==1){
              titleUploadfile.innerHTML="{{ __('message.UFJ.file') }} "+parametr.filename+"."+parametr.type+" {{ __('message.UFJ.uploaded') }}";
              titleUploadfile.style.color="#059292";
              btnloadfile.hidden=true;
              btnsuccessfile.hidden=false;
              filepath.value=parametr.path;
              setTimeout(() => {
                  btnsuccessfile.hidden=true;
                  btndeletefile.hidden=false;
                  btndeletefile.onclick=function(){
                      titleUploadfile.innerHTML="{{ __('message.UFJ.tryDeleteFile') }}";
                      titleUploadfile.style.color="#ff0000";
                      btndeletefile.disable=true;
                      var fd = new FormData();
                      fd.append('_token',document.getElementsByName('_token')[0].value);
                      fd.append('type',parametr.type);
                      fd.append('folder','publicfile');
                      ajaxfileuploader(parametr.deletelink,fd,defualtFileDiv);
                  };

              }, 1000);

             }else{
                  toast_dialog_error(parametr.error);
                  defualtFileDiv([],1);
             }
        }


        function fileuploaded(path){
    let result1 = path.lastIndexOf("/");
    let result2 = path.lastIndexOf(".");
    let name = path.substring(result1+1,result2);
    let type = path.substring(result2+1);

    if(result1>=0 & result2>=result1+1){
        let link="{{ url('deletefile') }}/"+name;
        divfilechooser.hidden=true;
        titleUploadfile.innerHTML="{{ __('message.UFJ.audio') }} "+name+"."+type+" {{ __('message.UFJ.uploaded') }}";
      titleUploadfile.style.color="#059292";
      filepath.value=path;
      titleUploadfile.hidden=false;
        btndeletefile.hidden=false;
          btndeletefile.onclick=function(){
              titleUploadfile.innerHTML="{{ __('message.UFJ.tryDeleteAudio') }}";
              titleUploadfile.style.color="#ff0000";
              btndeletefile.disable=true;
              var fd = new FormData();
              fd.append('_token',document.getElementsByName('_token')[0].value);
              fd.append('type',type);
              fd.append('folder','publicfile');
              ajaxfileuploader(link,fd,defualtFileDiv);
        };
    }
  }


        function defualtFileDiv(parametr,status){
          if(status==1){
              titleUploadfile.innerHTML="{{ __('message.UFJ.deletedFile') }}";
              setTimeout(() => {
                  btnsuccessfile.hidden=true;
              btndeletefile.hidden=true;
              btnloadfile.hidden=true;
              titleUploadfile.hidden=true;
              divfilechooser.hidden=false;
              filepath.value='';

              }, 1000);
          }else{
              toast_dialog_error("{{ __('message.UFJ.fileError') }}");
          }
        }

  function uploadaudios() {

      var audio =audio_upload.files;
      if(audio.length==0){
      alert("Please first choose or drop any audio(s)...");
      return;
      }

      titleUploadaudio.hidden=false;
      titleUploadaudio.innerHTML="{{ __('message.UFJ.uploading') }} "+audio[0].name;
      titleUploadaudio.style.color="#000d83";
      btnloadaudio.hidden=false;
      divaudiochooser.hidden=true;
      var fd = new FormData();
      fd.append('_token',document.getElementsByName('_token')[0].value);
      fd.append('myfile',audio_upload.files[0]);
      fd.append('folder','audio');
      audio_upload.value="";
      ajaxfileuploader('{{ route("uploadfile")}}' , fd,responseaudio);
  }
  //   function responseaudio(audioname,deleteLink,status){
  function responseaudio(parametr,status){
     if(status==1){
      titleUploadaudio.innerHTML="{{ __('message.UFJ.audio') }} "+parametr.filename+"."+parametr.type+" {{ __('message.UFJ.uploaded') }}";
      titleUploadaudio.style.color="#059292";
      btnloadaudio.hidden=true;
      btnsuccessaudio.hidden=false;
      audiopath.value=parametr.path;
      setTimeout(() => {
          btnsuccessaudio.hidden=true;
          btndeleteaudio.hidden=false;
          btndeleteaudio.onclick=function(){
              titleUploadaudio.innerHTML="{{ __('message.UFJ.tryDeleteAudio') }}";
              titleUploadaudio.style.color="#ff0000";
              btndeleteaudio.disable=true;
              var fd = new FormData();
              fd.append('_token',document.getElementsByName('_token')[0].value);
              fd.append('type',parametr.type);
              fd.append('folder','audio');
              ajaxfileuploader(parametr.deletelink,fd,defualtaudioDiv);
          };

      }, 1000);

     }else{
          toast_dialog_error(parametr.error);
          defualtaudioDiv([],1);
     }
  }

  function defualtaudioDiv(parametr,status){
      if(status==1){
          titleUploadaudio.innerHTML="{{ __('message.UFJ.deletedAudio') }}";
          setTimeout(() => {
              btnsuccessaudio.hidden=true;
          btndeleteaudio.hidden=true;
          btnloadaudio.hidden=true;
          titleUploadaudio.hidden=true;
          divaudiochooser.hidden=false;
          audiopath.value='';

          }, 1000);
      }else{
          toast_dialog_error("{{ __('message.UFJ.audioError') }}");
      }
  }

  function audiouploaded(path){
    let result1 = path.lastIndexOf("/");
    let result2 = path.lastIndexOf(".");
    let name = path.substring(result1+1,result2);
    let type = path.substring(result2+1);

    if(result1>=0 & result2>=result1+1){
        let link="{{ url('deletefile') }}/"+name;
        divaudiochooser.hidden=true;
        titleUploadaudio.innerHTML="{{ __('message.UFJ.audio') }} "+name+"."+type+" {{ __('message.UFJ.uploaded') }}";
      titleUploadaudio.style.color="#059292";
      audiopath.value=path;
      titleUploadaudio.hidden=false;
        btndeleteaudio.hidden=false;
          btndeleteaudio.onclick=function(){
              titleUploadaudio.innerHTML="{{ __('message.UFJ.tryDeleteAudio') }}";
              titleUploadaudio.style.color="#ff0000";
              btndeleteaudio.disable=true;
              var fd = new FormData();
              fd.append('_token',document.getElementsByName('_token')[0].value);
              fd.append('type',type);
              fd.append('folder','audio');
              ajaxfileuploader(link,fd,defualtaudioDiv);
        };
    }
  }


  function ajaxfileuploader(link,data,func){
          var xhr = new XMLHttpRequest();
          xhr.open('POST', link, true);
          //   xhr.upload.onprogress = function(e) {
          //     if (e.lengthComputable) {
          //       var percentComplete = (e.loaded / e.total) * 100;
          //       console.log(percentComplete + '% uploaded');
          //     }
          //   };
          xhr.onload = function() {
              if (this.status == 200) {
                  let get=JSON.parse(this.responseText);
                  if('success' in get){
                      func(get,1);
                      }else{
                          func(get,0);
                          let txt='';
                          for(let er in get.error ){}
                      }
              }else{
                get.error="{{ __('message.UFJ.server_error') }}";
                func(get,0);
              }
          };
          xhr.send(data);

      }
      </script>
