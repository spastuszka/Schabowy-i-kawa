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
        <input type="text" placeholer="sky color" onChange={skyColor}/>
        <input type="text" placeholer="grass color" onChange={grassColor}/>
      </div>
    )
  },
  save: function(){
    return (
     <p>Today the sky is x and the grass is y</p>
    )
  }
})