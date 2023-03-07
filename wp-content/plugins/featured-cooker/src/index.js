import "./index.scss"
import {useSelect} from "@wordpress/data"

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
  const allCooks = useSelect(select => {
    return select("core").getEntityRecords("postType","cooker",{per_page:-1})
  },[])

  if(allCooks == undefined) return <p>Loading ...</p>

  return (
    <div className="featured-cooker-wrapper">
      <div className="cooker-select-container">
        <select onChange={e => props.setAttributes({cookID: e.target.value})}>
          <option value="">Select a cooker</option>
          <option value="1" selected={props.attributes.cookID == 1}>1</option>
          <option value="2" selected={props.attributes.cookID == 2}>2</option>
          <option value="3" selected={props.attributes.cookID == 3}>3</option>
        </select>
      </div>
      <div>
        Tu będzie podgląd jakiego kucharza wybraliśmy i jak to wygląda.
      </div>
    </div>
  )
}