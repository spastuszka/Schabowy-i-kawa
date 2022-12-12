wp.blocks.registerBlockType('gutenberg-custom-plugin/test-gutenberg-block',{
  title: "Gutenberg Block",
  icon: "smiley",
  category: "common",
  edit: function(){
    return(
      <div>
        <p>Hello. This is a paragraph.</p>
        <h4>Hi there!</h4>
      </div>
    )
  },
  save: function(){
    return (
      <>
        <h3>This is a h3 fragment</h3>
        <h5>This is a h5 fragment</h5>
      </>
    )
  }
})