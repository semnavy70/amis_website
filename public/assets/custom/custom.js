$('input:file').on('change', function () {
    let fileName = $(this).val().replace('C:\\fakepath\\', " ");
    $(this).next('.custom-file-label').html(fileName);
});

function convertToSlug(str) {
    str = str.replace(/[`~!@#$%^&*()_\-+=\[\]{};:'"\\|\/,.<>?\s]/g, ' ')
        .toLowerCase();

    str = str.replace(/^\s+|\s+$/gm, '');
    str = str.replace(/\s+/g, '-');
    console.log(str)
    $("#slug").val(str);
}

function previewInput(input, image) {
    if (input.files && input.files[0]) {
        let reader = new FileReader();

        reader.onload = function (e) {
            image.attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

function showParent(child) {
    let parent = $(child).parent();
    parent.removeClass('d-none');
}

function displayPreviewImage(input,id) {
    let image = $(id);
    previewInput(input,image);
    showParent(image);
}

function displayVoice(input,id) {
    let voice = $(id);
    previewInput(input,voice);
}

function gotoPage(url) {
    window.open(url, "_self");
}

function refreshPage() {
    let refreshBtn = $("#refresh-btn");
    refreshBtn.addClass('rotate');
    location.reload();
}

function showDatePicker(id) {
    $(id).datepicker({
        timeFormat: 'h:mm p',
        interval: 15,
        minTime: '10',
        maxTime: '6:00pm',
        defaultTime: '11',
        startTime: '10:00',
        dynamic: false,
        dropdown: true,
        scrollbar: true
    });
}