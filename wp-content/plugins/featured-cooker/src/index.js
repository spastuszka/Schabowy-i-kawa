import "./index.scss"
import {useSelect} from "@wordpress/data"
import {useState, useEffect} from "react"
import apiFetch from "@wordpress/api-fetch"

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

  /* state-related variables and addition of an initial value */
  const [thePreview, setThePreview] = useState("")

  /* Created effect every time when state parameter change - cookID */
  useEffect(() => {
    async function go(){
      const response = await apiFetch(
        { 
          path: `featuredCooker/v1/getHTML?cookID=${props.attributes.cookID}`,
          method: "GET",
        })
        setThePreview(response)
    }
    go()
  }, [props.attributes.cookID])

  const allCooks = useSelect(select => {
    return select("core").getEntityRecords("postType","cooker",{per_page:-1})
  },[])

  if(allCooks == undefined) return <p>Loading ...</p>

  return (
    <div className="featured-cooker-wrapper">
      <div className="cooker-select-container">
        <select onChange={e => props.setAttributes({cookID: e.target.value})}>
          <option value="">Select a cooker</option>
          {allCooks.map(cook =>{
            return(
              <option value={cook.id} selected={props.attributes.cookID == cook.id}>{cook.title.rendered}</option>
            )
          })}
        </select>
      </div>
      <div>
        Tu będzie podgląd jakiego kucharza wybraliśmy i jak to wygląda.
      </div>
    </div>
  )
}