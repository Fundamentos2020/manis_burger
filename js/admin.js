var visible_panel = 0
document.getElementById('btn-menu').addEventListener('click', function(e){
    
    const panel = document.getElementById('panel')
    panel.style.display='inline'
    if(visible_panel===0)
    {
        panel.style.visibility='hidden'
        panel.style.overflow='hidden'
        panel.style.opacity = '0'
        visible_panel=1
    }
    else{
        
        panel.style.visibility='visible'
        panel.style.overflow='visible'
        panel.style.opacity = '1'
        visible_panel=0
    }

    e.preventDefault()
    panel.style.transition= 'ease 0.5s all'

})



