document.getElementById('btn-menu').addEventListener('click', muestraMenu)
var visible_panel = 0

function muestraMenu(e){
    e.preventDefault()
    const panel = document.getElementById('panel')
    if(visible_panel===0)
    {
        panel.style.visibility='hidden'
        panel.style.opacity = '0'
        visible_panel=1
    }
    else{
        panel.style.visibility='visible'
        panel.style.opacity = '1'
        visible_panel=0
    }

    
    panel.style.transition= 'ease 0.5s all'
}

