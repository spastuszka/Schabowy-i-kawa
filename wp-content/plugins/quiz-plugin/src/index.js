import './index.scss'
import {TextControl, Flex, FlexBlock, FlexItem, Button, Icon, PanelBody, PanelRow, ColorPicker} from '@wordpress/components'
import {InspectorControls, BlockControls, AlignmentToolbar, useBlockProps} from '@wordpress/block-editor'

(function (){
  let locked = false

  wp.data.subscribe(function(){
    const results = wp.data.select("core/block-editor").getBlocks().filter(function(block){
      return block.name == "quiz-plugin/gutenberg-block-quiz" && block.attributes.correctAnswer == undefined
    })

    if(results.length && locked == false){
      locked = true
      wp.data.dispatch("core/editor").lockPostSaving("noanswer")
    }

    if(!results.length && locked){
      locked = false
      wp.data.dispatch("core/editor").unlockPostSaving("noanswer")
    }
  })
})()

wp.blocks.registerBlockType('quiz-plugin/gutenberg-block-quiz',{
  title: "Quiz Block",
  icon: "smiley",
  category: "common",
  attributes:{
    question:{type:"string"},
    answers:{type:"array", default:[""]},
    correctAnswer: {type:"number", default:undefined},
    bgColor: {type: "string", default: "#EBEBEB"},
    theAlignment: {type: "string", default: "left"}
  },
  description:"Give your audience a chance to prove their comprehension",
  example: {
    attributes:{
      question: "What is the most popular web CMS?",
      correctAnswer: 2,
      answers: ['Prestashop', 'WordPress', 'Joomla'],
      theAlignment: "left",
      bgColor: "#CFE8F1"
    }
  },
  edit: EditComponent,
  save: function(props){
    return null
  },
})

function EditComponent(props){
  
  const blockProps = useBlockProps({
    className:'paying-attention-edit-block',
    style:{backgroundColor: props.attributes.bgColor}
  });

  function updateQuestion(value){
    props.setAttributes({question:value})
  }

  function deleteAnswer(indexToDelete){
    const newAnswers = props.attributes.answers.filter(function(x, index){
      return index != indexToDelete
    })
    props.setAttributes({
      answers: newAnswers
    })

    if(indexToDelete == props.attributes.correctAnswer){
      props.setAttributes({
        correctAnswer: undefined
      })
    }
  }

  function markAsCorrect(indexToMark){
    props.setAttributes({
      correctAnswer: indexToMark
    })
  }

  return(
    <div {...blockProps}>
      <BlockControls>
        <AlignmentToolbar value={props.attributes.theAlignment} onChange={x => props.setAttributes({theAlignment: x})}/>
      </BlockControls>
      <InspectorControls>
        <PanelBody title="Background Color" initialOpen={true}>
          <PanelRow>
            <ColorPicker color={props.attributes.bgColor} onChangeComplete={x => props.setAttributes({bgColor: x.hex})} disableAlpha={true}/>
          </PanelRow>
        </PanelBody>
      </InspectorControls>
      <TextControl
         label="Question:" value={props.attributes.question} onChange={updateQuestion} style={{fontSize:"20px"}}
      />
      <p style={{fontSize:"13px", margin:"20px 0 8px 0"}}>Answers:</p>
      {props.attributes.answers.map(function(answer, index){
        return(
          <Flex>
            <FlexBlock>
              <TextControl autoFocus = {answer == undefined} value={answer} onChange={(newValue)=>{
                const newAnswers = props.attributes.answers.concat([])
                newAnswers[index] = newValue
                props.setAttributes({
                  answers: newAnswers
                })
              }}/>
            </FlexBlock>
            <FlexItem>
              <Button onClick={()=> markAsCorrect(index)}>
                <Icon className='mark-as-correct' icon={props.attributes.correctAnswer == index ? "star-filled" : "star-empty"}/>
              </Button>
            </FlexItem>
            <FlexItem>
              <Button variant='link' className='question-delete-btn' onClick={()=> deleteAnswer(index)}>Delete</Button>
            </FlexItem>
          </Flex>
        )
      })}
      <Button variant="primary" onClick={()=>{
        props.setAttributes({
          answers: props.attributes.answers.concat([undefined])
        })
      }}>Add another answer</Button>
    </div>
  )
}