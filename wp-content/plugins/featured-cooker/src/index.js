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
    updateTheCookMeta()
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


  function updateTheCookMeta(){

    /* Tutaj bierzemy pod uwagę wszystkie bloki, które mogą wystąpić w poście
    moemy rpzecie dodać wiele wizytówek kucharzy w jednym poście. Filtrujemy
    zatem je, tak aby u kadego kucharza się pojkawiły */

    const cookFromMeta = wp.data.select("core/block-editor")
      .getBlocks()
      .filter(x => x.name == "ourplugin/featured-cooker")/* Filtrujemy tylko bloki z kucharzami */
      .map(x => x.attributes.cookID) /* Modyfikujemy na nową tablicę, tylko id kucharzy występujących w danym poście */
      .filter((x, index, arrCook) => {
        /* Filtrowanie wyników aby nie było duplikatów w danej tablicy */
        return arrCook.indexOf(x) == index
      } )
      console.log(cookFromMeta);
    /* Ustawienie wartości meta, aby dowiedzieć się, ile wystąpień danego kucharza jest w poście, wartości te później wykorzystamy do wyświetlenia listy postów w opisiue samego kucharza. */
    wp.data.dispatch("core/editor").editPost({meta: {featurecooker: cookFromMeta}});
  }

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
        {/* This is the parameter that allows React to display content it normally deems unsafe */}
        <div dangerouslySetInnerHTML={{__html: thePreview}}></div>
      </div>
    </div>
  )
}