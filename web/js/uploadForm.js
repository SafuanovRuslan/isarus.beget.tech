$(window).on('load', () => {
    let label  = $('#imageFiles_label');
    let submit = $('#submit');
    let input  = $('input[type=file]')[0]
    let help   = $('.help-block');

    let loader = new Loader(label, submit, input, help);

    $('input[type=file]').on('change', () => {
        let validation = loader.validation();
        if ( validation.result ) {
            loader.render();
        } else {
            loader.cleanSelectedFiles();
            loader.render();
            alert(validation.message);
        }
    })

    submit.on('mouseup', () => {
        loader.send();
    })
})