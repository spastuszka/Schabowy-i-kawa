import "./index.scss"

wp.blocks.registerBlockType("ourplugin/featured-cooker", {
  title: "Cooker Callout",
  description: "Include a short description and link to a cooker of your choice",
  icon: "welcome-learn-more",
  category: "common",
  edit: EditComponent,
  save: function () {
    return null
  }
})

function EditComponent() {
  return (
    <div className="featured-cooker-wrapper">
      <div className="cooker-select-container">
        Tu będzie menu rozwijane wszystkich kucharzy
      </div>
      <div>
        Tu będzie podgląd jakiego kucharza wybraliśmy i jak to wygląda.
      </div>
    </div>
  )
}