let first;

function setter() {
    setSize($('.game-box').attr('data-size'))
    playing = true
    gamevalue = $('.game-box').attr('data-game')
    first = false
    numbers()
    resize()
    toLeft()
    setTimeout(() => {resize(); toLeft()}, 100)
    setTimeout(() => {resize(); toLeft()}, 200)
    setTimeout(() => {resize(); toLeft()}, 300)
    setTimeout(() => {resize(); toLeft()}, 400)
    setTimeout(() => {resize(); toLeft()}, 500)

    hrColor('.placeholder', true)
    hrColor('.draw', true)
    hrColor('.eraser', true)
    hrColor('#game', true)
    hrColor('#confetti', true)
    hrColor('#btn', false)
    $('.smaller a').css('color', getColor())

    $('.draw').trigger('click')
}

$( window ).resize(() => {
    resize()
    toLeft()
    setTimeout(() => {resize(); toLeft()}, 100)
    setTimeout(() => {resize(); toLeft()}, 200)
    setTimeout(() => {resize(); toLeft()}, 300)
    setTimeout(() => {resize(); toLeft()}, 400)
    setTimeout(() => {resize(); toLeft()}, 500)
})

function resize() {
    $('.number-down').css({
        'height': $('.rect').outerWidth() + 'px',
        'font-size': ($('.rect').outerWidth() * 0.8) + 'px',
    })
    $('.number-up').css({
        'width': $('.rect').outerWidth() + 'px',
        'font-size': ($('.rect').outerWidth() * 0.8) + 'px',
        'line-height': ($('.rect').outerWidth()) + 'px',
    })
    $('#game').css({
        'max-width': 'min(calc(100% - ' +$('.number-left-box').outerWidth()+ 'px), 80rem)',
    })

    $('.up').css({
        'margin-left': $('.number-left-box').outerWidth() + 'px'
    })
}

function numbers() {
    let data = gamevalue.split('}')

    // left
    for (let i = 0; i < data.length; i++) {
        let row = data[i].split(';')
        let text = ''
        let num = 0
        for (let r = 0; r < row.length; r++) {
            if (row[r] === '1') {
                num++
            } else {
                if (r > 0) {
                    if (row[r-1] !== '0') {
                        text += num + ' '
                    }
                }
                num = 0
            }
            if (r === row.length - 1) {
                if (num > 0) {
                    text += num + ' '
                }
            }
        }
        $('.number-left-box').append('<p class="number-down row-' + i + '">' + text + '</p>')
    }
    
    let size = $('.game-box').attr('data-size')
    let numbers = gamevalue.replace(/[^0-1]/g, "")

    for (let c = 0; c < size; c++) {
        let text = ''
        let num = 0
        let last = false
        for (let i = 0; i < size; i++) {
            if (numbers.charAt(c + i + (i*size) - i) === '1') {
                num++
                last = true
            } else {
                if (last) {
                    text += num + '<br>'
                }
                num = 0
                last = false
            }
            if (i === size - 1) {
                if (num > 0) {
                    text += num + '<br>'
                }
            }
        }
        $('.up').append('<p class="number-up col-' + c + '">' + text + '</p>')
    }
}

function toLeft() {
    let px = parseInt($('.number-left-box').outerWidth())
    if ($('body').outerWidth() - $('.down').outerWidth() - 20 > px*1.1) {
        $('.down').css({'margin-left': -px})
        $('.up').css({'margin-left': '0px'})
        $('.left').addClass('show')
        $('.bottom').removeClass('show')
    } else  {
        $('.down').css({'margin-left': '0'})
        $('.up').css({'margin-left': px + 'px'})
        $('.left').removeClass('show')
        $('.bottom').addClass('show')
    }
}

function checkWin() {
    let game = $('#game')
    let size = $('.game-box').attr('data-size')
    let save = ''
    let counter = 0

    for (let row = 0; row < size; row++) {
        for (let col = 0; col < size; col++) {
            if (game.find('#' + row).find('div')[col].classList.length == 1 || game.find('#' + row).find('div')[col].classList.contains('gray')) {
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

    if (gamevalue === save)
        win()
}

function hack() {
    let size = $('.game-box').attr('data-size')
    let gameHack = gamevalue.split('}')

    for (let row = 0; row < size; row++) {
        let gameHacked = gameHack[row].split(';')
        for (let col = 0; col < gameHacked.length; col++) {
            if (gameHacked[col] === '1') {
                $('#' + row).find('div')[col].classList.add('black')
            }
        }
    }
}

$('body').on('click', '#like', () => {
    $('#like').toggleClass('liked')

    fetch('/game/'+$('.game-box').data('name')+'/like', {
        method: 'post',
        headers: {
            'content-type': 'application/json',
            'accept': 'application/json',
            "X-CSRF-Token": $('#token_like').val()
        }
    })
})

$('body').on('click', '#share', () => {
    //$(location).attr('href', '/share/'+$('.game-box').data('name'))
    window.open('/share/'+$('.game-box').data('name'), '_blank');
})


let confirmation = false
$('body').on('submit', '#delete', (ev) => {
    if (!confirmation) {
        ev.preventDefault()
        if (prompt('Are you sure you want to delete your game?\n Type \'yes\' to confirm!') === 'yes') {
            confirmation = true
            $('#delete').trigger('submit')
        }
    }
})