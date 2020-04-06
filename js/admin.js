var visible_panel = 0
document.getElementById('btn-menu').addEventListener('click', function(e){
    e.preventDefault()
    const panel = document.getElementById('panel')
    if(visible_panel===0)
    {
        panel.style.display='none'
        panel.style.visibility='hidden'
        panel.style.overflow='hidden'
        panel.style.opacity = '0'
        visible_panel=1
    }
    else{
        panel.style.display='block'
        panel.style.visibility='visible'
        panel.style.overflow='visible'
        panel.style.opacity = '1'
        visible_panel=0
    }

    
    panel.style.transition= 'ease 0.5s all'

})



