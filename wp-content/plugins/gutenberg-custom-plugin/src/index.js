wp.blocks.registerBlockType('gutenberg-custom-plugin/test-gutenberg-block',{
  title: "Gutenberg Block",
  icon: "smiley",
  category: "common",
  edit: function(){
    return wp.element.createElement("h3",null,"Hello, this is the admin editor screen")
  },
  save: function(){
    return wp.element.createElement("h1",null,"This is the frontend.")
  }
})