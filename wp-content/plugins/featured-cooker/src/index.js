import "./index.scss"

wp.blocks.registerBlockType("ourplugin/featured-cooker", {
  title: "Cooker Callout",
  description: "Include a short description and link to a cooker of your choice",
  icon: "welcome-learn-more",
  category: "common",
  attributes:{
    cookID:{type:"string"},
  },
  edit: EditComponent,
  save: function () {
    return null
  }
})

function EditComponent(props) {
  return (
    <div className="featured-cooker-wrapper">
      <div className="cooker-select-container">
        <select>
          <option value="1">1</option>
          <option value="2">2</option>
          <option value="3">3</option>
        </select>
      </div>
      <div>
        Tu będzie podgląd jakiego kucharza wybraliśmy i jak to wygląda.
      </div>
    </div>
  )
}