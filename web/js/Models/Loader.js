class Loader {
    maxFiles = 5;
    label  = null;
    submit = null;
    input  = null;
    enabledTypes = [ '.jpeg', '.jpg', '.png' ];

    constructor(label, submit, input, help) {
        this.label  = label;
        this.submit = submit;
        this.input  = input;
        this.help   = help;
        this.render();
    }

    render() {
        if ( this.input.files.length ) {
            this.label.text(`Выбрано (${this.input.files.length})`);
            this.submit.removeAttr('disabled');
        } else {
            this.label.text('Выбрать изображения');
            this.submit.attr('disabled', 'disabled');
        }
    }

    send() {
        this.submit.text('Отправляем...');
        setTimeout(() => {
            this.submit.trigger('click')
        }, 200);
        setTimeout(() => {
            this.submit.trigger('click')
        }, 400);
    }

    validation() {
        let isCorrect = {result: true};
        let files = Array.from(this.input.files);
        files.forEach((file) => {
            let type = file.name.match(/\.([\w]+)$/)[0];

            if ( this.enabledTypes.indexOf(type) === -1 ) {
                isCorrect = {result: false, message: `Допустима загрузка следующих файлов: ${this.enabledTypes.join(' ')}`};
            }
        })

        if ( files.length > this.maxFiles ) {
            isCorrect = {result: false, message: `Допустима загрузка не более ${this.maxFiles} файлов за раз`};
        }
            
        return isCorrect;
    }

    cleanSelectedFiles() {
        this.input.value = '';
    }
}