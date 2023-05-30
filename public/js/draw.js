window.onload = () => {
    hrColor('#game', true)
    hrColor('.slider', false)

    hrColor('.clear', true)
    hrColor('.draw', true)
    hrColor('.eraser', true)
    hrColor('.save', false)
    hrColor('.save', true)

    setSize($('#range').val())
    $('.draw').trigger('click')
}

window.onresize = () => {
    resize()
}

function setter() {
    setSize($('#range').val())
    playing = false
}

function save() {
    let game = $('#game')
    let size = $('#range').val()
    let save = ''
    let counter = 0

    for (let row = 0; row < size; row++) {
        for (let col = 0; col < size; col++) {
            if (game.find('#' + row).find('div')[col].classList.length == 1) {
                save += 0
            } else {
                save += 1
                counter++;
            } if (col + 1 < size) {
                save += ';'
            }
        }
        if (row + 1 < size)
            save += "}"
    }

    if (counter < size*size / 3) {
        error('percent-error', 'more than 33% needs to be filled out to save. You are at ' + checkPercentage() + '%', () => {
            $('#percent-error').addClass('close')
            setTimeout(() => {
                $('#percent-error').remove()
                $('body').removeClass('scroll')
            }, 300)
        })
    } else {
        window.localStorage.setItem('save', save)
        window.localStorage.setItem('size', size)
        window.localStorage.setItem('percentage', (counter*100)/(size*size))
        $(location).attr('href', '/save/')
    }
}

$('#range').on('input change', () => {
    let size = $('#range').val()
    $('#showing').text(size)
    setSize(size)    
})

$('.clear').on('click', () => {
    setSize($('#range').val())
    checkPercentage()
})

$('.save').on('click', () => {
    save()
})