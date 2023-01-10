import './index.scss'
import {TextControl, Flex, FlexBlock, FlexItem, Button, Icon} from '@wordpress/components'
wp.blocks.registerBlockType('quiz-plugin/gutenberg-block-quiz',{
  title: "Quiz Block",
  icon: "smiley",
  category: "common",
  attributes:{
    skyColor:{
      type:"string",
    },
    grassColor:{
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
        label="Question:"
      />
      <p>Answers:</p>
      <Flex>
        <FlexBlock>
          <TextControl />
        </FlexBlock>
        <FlexItem>
          <Button>
            <Icon/>
          </Button>
        </FlexItem>
        <FlexItem></FlexItem>
      </Flex>
    </div>
  )
}