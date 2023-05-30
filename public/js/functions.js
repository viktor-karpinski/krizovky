let drag, drawing, playing, gamevalue, over;

window.onload = () => {
    over = false
    drag = false;
    drawing = 0;
    setter()
}

function setSize(size) {
    let game = $('#game')

    game.empty()
    for (let row = 0; row < size; row++) {
        game.append('<div class="game-row" id="'+row+'"></div>')
        for (let col = 0; col < size; col++) {
            game.find('#' + row).append('<div class="rect"></div>')
        }
    }
    resize()
}

function resize() {
    let size = $('#range').val()
}

function draw(ev) {
    if (drag && !over) {
        if ($(ev.target)[0].classList[0] === 'rect') {
            if (drawing === 0) {
                $(ev.target).addClass('black')
                play()
            } else if (drawing === 1) {
                $(ev.target).removeClass('gray')
                $(ev.target).removeClass('black')
            } else {
                $(ev.target).addClass('gray')
            }
            if (playing) {
                checkWin()
            }
        }
    }
    checkPercentage()
}

function drawPhone(x, y) {
    //y = y + window.scrollY / 3 - document.getElementsByClassName('rect')[0].offsetHeight
    if (drag && !over) {
        let rects = document.getElementsByClassName('rect')
        for (let i = 0; i < rects.length; i++) {
            let rx = rects[i].getBoundingClientRect().left
            let ry = rects[i].getBoundingClientRect().top
            if (x >= rx && x <= rx + rects[i].offsetWidth &&
                y >= ry + window.scrollY && y <= (ry + window.scrollY) + rects[i].offsetHeight) {
                    if (drawing === 0) {
                        rects[i].classList.add('black')
                        play()
                    } else if (drawing === 1) {
                        rects[i].classList.remove('black')
                        rects[i].classList.remove('gray')
                    } else {
                        rects[i].classList.add('gray')
                    }
                }
        }
        if (playing) {
            checkWin()
        }
    }

    checkPercentage()
}

function checkPercentage() {
    if (!playing) {
        let p = Math.floor(($('.black').length * 100)/($('#range').val()*$('#range').val()))
        $('#percent').text(p)
        return p
    }
}

function error(id, text, close) {
    let msgBox = document.createElement('article'),
        msg = document.createElement('p'),
        btn = document.createElement('button')
        msgBox.classList.add('error-box')
        msgBox.id = id
        msg.innerText = text
        btn.innerText = 'ok'
        btn.onclick = () => {
            (close)()
        }
    
    $(msgBox).append(msg)
    $(msgBox).append(btn)
    $('main').append(msgBox)
    $('body').addClass('scroll')
}

async function play() {
    if (typeof first !== 'undefined' && !first) {
        first = true
        fetch('/game/'+$('.game-box').data('name')+'/play', {
            method: 'post',
            headers: {
                'content-type': 'application/json',
                'accept': 'application/json',
                "X-CSRF-Token": $('#token_play').val()
            }
        }).then((res) => {
            if (!res.ok)
                first = false
        })
    }
}

$('body').on('mousedown', (ev) => {
    drag = true
    draw(ev)
}).on('mousemove', (ev) => {
    draw(ev)
}).on('mouseup', () => {
    drag = false
}).on('keydown', (ev) => {
    if (ev.keyCode === 13)
        $('#sendForm').trigger('click')
}).on('touchstart', (ev) => {
    drag = true
    draw(ev)
}).on('touchmove', (ev) => {
    let touch = ev.originalEvent.touches[0] || ev.originalEvent.changedTouches[0]
    drawPhone(touch.pageX, touch.pageY)
}).on('touchend', (ev) => {
    draw(ev)
})

$('.placeholder').on('click', () => {
    drawing = 2
    $('.placeholder').css('background-color', getColor())
    $('.draw, .eraser').css('background-color', 'transparent')
})

$('.draw').on('click', () => {
    drawing = 0
    $('.draw').css('background-color', getColor())
    $('.eraser, .placeholder').css('background-color', 'transparent')
})

$('.eraser').on('click', () => {
    drawing = 1
    $('.eraser').css('background-color', getColor())
    $('.draw, .placeholder').css('background-color', 'transparent')
})