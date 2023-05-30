

let c = $('#win')[0]
let ctx = c.getContext("2d")
let sent = false

class confetti {
    constructor(x, y, deg, color, direction) {
        this.x = x
        this.y = y
        this.deg = deg
        this.color = color
        this.direction = direction
    }

    fall() {
        this.y += 15
        this.deg += 3
        if (this.direction > 10)
            this.x += 2
        else
            this.x -= 2
    }

    create() {
        rect(this.x, this.y, 10, 10, this.deg, this.color)
    }
}


function rect(x, y, w, h, deg, color) {
    ctx.fillStyle = color
    ctx.translate(x, y)
    ctx.rotate(deg * Math.PI / 180);
    ctx.fillRect(0, 0, w, h);
    ctx.setTransform(1, 0, 0, 1, 0, 0);
}

function win() {
    $('#win').css({'display': 'block'})
    c.width = document.body.clientWidth;
    c.height = document.body.clientHeight * 2;
    let soletis = []

    if (!sent) {
        sent = true
        heart()
        fetch('/game/'+$('.game-box').data('name')+'/win', {
            method: 'post',
            headers: {
                'content-type': 'application/json',
                'accept': 'application/json',
                'X-CSRF-Token': $('#token_win').val()
            }
        })
    }

    setTimeout(() => {
        window.getSelection().empty()
        for (let i = 0; i < 300; i++) {
            let x = Math.random() * document.body.offsetWidth
            let y = -(Math.random() * (document.body.clientHeight))
            let deg = Math.random() * 360 + 1
            soletis.push(new confetti(x, y, deg, colors[Math.floor(Math.random() * 6 + 1)], Math.random()*20))
        }

    }, 100)

    let int = setInterval(() => {
        ctx.clearRect(0, 0, c.width, c.height);
        for (let i = 0; i < soletis.length; i++) {
            soletis[i].fall()
            soletis[i].create()
        }
    }, 20)

    setTimeout(() => {
        clearInterval(int)
        $('#win').css({'display': 'none'})
        over = true
        $('#confetti-box').removeClass('hidden')
        $('#confetti').addClass('show')
    }, 3000)
}

$('#confetti').on('click', () => win(true))