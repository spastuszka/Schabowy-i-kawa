import './index.scss'
import {TextControl, Flex, FlexBlock, FlexItem, Button, Icon} from '@wordpress/components'
wp.blocks.registerBlockType('quiz-plugin/gutenberg-block-quiz',{
  title: "Quiz Block",
  icon: "smiley",
  category: "common",
  attributes:{
    question:{
      type:"string",
    },
  },
  edit: EditComponent,
  save: function(props){
    return null
  },
})

function EditComponent(props){
    
  function updateSkyColor(e){
    props.setAttributes({
      skyColor: e.target.value
    })
  }

  function updateGrassColor(e){
    props.setAttributes({
      grassColor: e.target.value
    })
  }

  return(
    <div className='paying-attention-edit-block'>
      <TextControl
        label="Question:" value={props.attributes.question} onChange={updateQuestion} style={{fontSize:"20px"}}
      />
      <p style={{fontSize:"13px", margin:"20px 0 8px 0"}}>Answers:</p>
      <Flex>
        <FlexBlock>
          <TextControl />
        </FlexBlock>
        <FlexItem>
          <Button>
            <Icon className='mark-as-correct' icon="star-empty"/>
          </Button>
        </FlexItem>
        <FlexItem>
          <Button variant='link' className='question-delete-btn'>Delete</Button>
        </FlexItem>
      </Flex>
      <Button variant="primary">Add another answer</Button>
    </div>
  )
}