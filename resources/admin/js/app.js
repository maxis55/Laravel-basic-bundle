
class MyUploadAdapter {
    constructor( loader, url ) {
        // Save Loader instance to update upload progress.
        this.loader = loader;
        this.url = url;
    }

    upload() {
        // Prepare the form data.
        return new Promise( ( resolve, reject ) => {
            this._initRequest();
            this._initListeners( resolve, reject );
            this._sendRequest();
        } );
    }

    abort() {
        if ( this.xhr ) {
            this.xhr.abort();
        }
    }
    // Initializes the XMLHttpRequest object using the URL passed to the constructor.
    _initRequest() {
        const xhr = this.xhr = new XMLHttpRequest();

        // Note that your request may look different. It is up to you and your editor
        // integration to choose the right communication channel. This example uses
        // the POST request with JSON as a data structure but your configuration
        // could be different.
        xhr.open( 'POST', this.url, true );
        xhr.setRequestHeader('X-CSRF-TOKEN', $('meta[name="csrf-token"]').attr('content'));
        xhr.responseType = 'json';
    }
    // Initializes XMLHttpRequest listeners.
    _initListeners( resolve, reject ) {
        const xhr = this.xhr;
        const loader = this.loader;
        const genericErrorText = 'Couldn\'t upload file:' + ` ${ loader.file.name }.`;

        xhr.addEventListener( 'error', () => reject( genericErrorText ) );
        xhr.addEventListener( 'abort', () => reject() );
        xhr.addEventListener( 'load', () => {
            const response = xhr.response;

            // This example assumes the XHR server's "response" object will come with
            // an "error" which has its own "message" that can be passed to reject()
            // in the upload promise.
            //
            // Your integration may handle upload errors in a different way so make sure
            // it is done properly. The reject() function must be called when the upload fails.
            if ( !response || response.error ) {
                return reject( response && response.error ? response.error.message : genericErrorText );
            }

            // If the upload is successful, resolve the upload promise with an object containing
            // at least the "default" URL, pointing to the image on the server.
            // This URL will be used to display the image in the content. Learn more in the
            // UploadAdapter#upload documentation.
            resolve( {
                default: response.url
            } );
        } );

        // Upload progress when it is supported. The FileLoader has the #uploadTotal and #uploaded
        // properties which are used e.g. to display the upload progress bar in the editor
        // user interface.
        if ( xhr.upload ) {
            xhr.upload.addEventListener( 'progress', evt => {
                if ( evt.lengthComputable ) {
                    loader.uploadTotal = evt.total;
                    loader.uploaded = evt.loaded;
                }
            } );
        }
    }
    // Prepares the data and sends the request.
    _sendRequest() {
        // Prepare the form data.
        const data = new FormData();
        data.append( 'upload', this.loader.file );

        // Send the request.
        this.xhr.send( data );
    }
}

function MyCustomUploadAdapterPlugin( editor ) {
    editor.plugins.get( 'FileRepository' ).createUploadAdapter = ( loader ) => {
        // Configure the URL to the upload script in your back-end here!
        return new MyUploadAdapter( loader, '/admin/ajax/quick-file-upload' );
    };
}

$.each(document.querySelectorAll('.ckeditor'),function(index,value){

    ClassicEditor
        .create(
            value,
            {
                extraPlugins: [
                    MyCustomUploadAdapterPlugin
                ],

            })
        .then(
        )
        .catch(error => {
            console.error(error);
        });
});




$(document).ready(function () {
    $('#is_free').on('change', function () {
        console.log($(this).val());
        if ($(this).val() == 0) {
            $('#delivery_cost').fadeIn();
        } else {
            $('#delivery_cost').fadeOut();
        }
    });
    $('.select2').select2({
        placeholder: 'Select'
    });
    $('.datatable').DataTable({

    });


    $('form.dynamic_form').on('change','select.type_select',function (e) {
        $('.type_specific_block').hide().find('input').attr('disabled',true);
        $('.'+$(this).val()+'-block').show().find('input').attr('disabled',false);
    });

});




window.$ = window.jQuery = jQuery;