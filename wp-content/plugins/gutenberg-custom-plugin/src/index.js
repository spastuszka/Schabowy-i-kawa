wp.blocks.registerBlockType('gutenberg-custom-plugin/test-gutenberg-block',{
  title: "Gutenberg Block",
  icon: "smiley",
  category: "common",
  attributes:{
    skyColor:{type:"string"},
    grassColor:{type:"string"},
  },
  edit: function(){
    return(
      <div>
        <input type="text" placeholder="sky color" onChange={updateSkyColor}/>
        <input type="text" placeholder="grass color" onChange={updateGrassColor}/>
      </div>
    )
  },
  save: function(){
    return (
     <p>Today the sky is x and the grass is y</p>
    )
  }
})