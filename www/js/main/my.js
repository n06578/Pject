window.onload = function () {
    'use strict';
  
    var Cropper = window.Cropper;
    var URL = window.URL || window.webkitURL;
    var container = document.querySelector('.img-container');
    var image = container.getElementsByTagName('img').item(0);
    var download = document.getElementById('download');
    var actions = document.getElementById('actions');
    var dataX = document.getElementById('dataX');
    var dataY = document.getElementById('dataY');
    var dataHeight = document.getElementById('dataHeight');
    var dataWidth = document.getElementById('dataWidth');
    var dataRotate = document.getElementById('dataRotate');
    var dataScaleX = document.getElementById('dataScaleX');
    var dataScaleY = document.getElementById('dataScaleY');
    var options = {
      aspectRatio: 1 / 1,
      preview: '.img-preview',
      ready: function (e) {
        console.log("chk2 : " +e.type);
      },
      cropstart: function (e) {
        console.log(e.type, e.detail.action);
      },
      cropmove: function (e) {
        console.log(e.type, e.detail.action);
      },
      cropend: function (e) {
        console.log(e.type, e.detail.action);
      },
      crop: function (e) {
        var data = e.detail;
  
        console.log("chk1 : " +e.type);
        dataX.value = Math.round(data.x);
        dataY.value = Math.round(data.y);
        dataHeight.value = Math.round(data.height);
        dataWidth.value = Math.round(data.width);
        dataRotate.value = typeof data.rotate !== 'undefined' ? data.rotate : '';
        dataScaleX.value = typeof data.scaleX !== 'undefined' ? data.scaleX : '';
        dataScaleY.value = typeof data.scaleY !== 'undefined' ? data.scaleY : '';
      },
      zoom: function (e) {
        console.log(e.type, e.detail.scale);
      }
    };
    var cropper = new Cropper(image, options);
    var originalImageURL = image.src;
    var uploadedImageType = 'image/jpeg';
    var uploadedImageName = 'cropped.jpg';
    var uploadedImageURL;
    
    // Methods
    actions.querySelector('.docs-buttons').onclick = function (event) {
        var e = event || window.event;
        var target = e.target || e.srcElement;
        var cropped;
        var result;
        var input;
        var data;
    
        if (!cropper) {
          return;
        }
    
        while (target !== this) {
          if (target.getAttribute('data-method')) {
            break;
          }
    
          target = target.parentNode;
        }
    
        if (target === this || target.disabled || target.className.indexOf('disabled') > -1) {
          return;
        }
    
        data = {
          method: target.getAttribute('data-method'),
          target: target.getAttribute('data-target'),
          option: target.getAttribute('data-option') || undefined,
          secondOption: target.getAttribute('data-second-option') || undefined
        };
    
        cropped = cropper.cropped;
    
        if (data.method) {
            console.log("test : " + data.target);
          if (typeof data.target !== 'undefined') {
            input = document.querySelector(data.target);
    
            if (!target.hasAttribute('data-option') && data.target && input) {
              try {
                data.option = JSON.parse(input.value);
              } catch (e) {
                console.log(e.message);
              }
            }
          }
    
          switch (data.method) {
            case 'getCroppedCanvas':
              try {
                data.option = JSON.parse(data.option);
                console.log("test1 : "+ data.option);
              } catch (e) {
                console.log(e.message);
              }
              if (uploadedImageType === 'image/jpeg') {
                if (!data.option) {
                  data.option = {};
                }
                data.option.fillColor = '#fff';
              }
              break;
            default:
          }
    
          result = cropper[data.method](data.option, data.secondOption);
          
          switch (data.method) {
            case 'getCroppedCanvas':
              if (result) {
                console.log("result : " + result);
                // Bootstrap's Modal
                
                $('.testbody').html(result);
                $('#getCroppedCanvasModal').modal().find('.modal-body').html(result);
                $('#getCroppedCanvasModal').modal("show");
                if (!download.disabled) {
                    download.download = uploadedImageName;
                    download.href = result.toDataURL(uploadedImageType);
                    // var formData = new FormData();
                    // formData.append('image', result);
    
                    // // 서버에 이미지를 전송
                    // fetch('save_file.php', {
                    //     method: 'POST',
                    //     body: formData
                    // })
                }
              }
              break;

            default:
          }
    
          if (typeof result === 'object' && result !== cropper && input) {
            try {
              input.value = JSON.stringify(result);
            } catch (e) {
              console.log(e.message);
            }
          }
        }
      };
      // Import image
      var inputImage = document.getElementById('inputImage');
    
      if (URL) {
        inputImage.onchange = function () {
          var files = this.files;
          var file;
    
          if (files && files.length) {
            file = files[0];
    
            if (/^image\/\w+/.test(file.type)) {
              uploadedImageType = file.type;
              uploadedImageName = file.name;
    
              if (uploadedImageURL) {
                URL.revokeObjectURL(uploadedImageURL);
              }
    
              image.src = uploadedImageURL = URL.createObjectURL(file);
    
              if (cropper) {
                cropper.destroy();
              }
    
              cropper = new Cropper(image, options);
              inputImage.value = null;
            } else {
              window.alert('Please choose an image file.');
            }
          }
        };
      } else {
        inputImage.disabled = true;
        inputImage.parentNode.className += ' disabled';
      }
};