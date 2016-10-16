
var $collectionHolder;
// setup an "add a tag" link

var $addTagLink = $('<div class="row pvbutton"><div class="col-sm-12"><br /><a href="#" class="add_tag_link btn btn-block btn-success fa fa-plus"> hinzufügen</a></div></div>');
var $addTagLinkTable = $('<tr class="pvbutton" ><td colspan="42"><a href="#" class="add_tag_link btn btn-block btn-success fa fa-plus"> hinzufügen</a></td></tr>');

jQuery(document).ready(function() {
    
    // Get the ul that holds the collection of tags

    $collectionHolder = $('.collection');
    $collectionHolder.find('.col-del').each(function() {
        addTagFormDeleteLink($(this));
    });

    // add the "add a tag" anchor and li to the tags ul

    $collectionHolder.each(function(){
        $collectionHold = $(this);
        if(!$collectionHold.hasClass('no-add')){
            if($collectionHold.prop('tagName') == "TABLE") {
                $collectionHold.append('<tr class="pvbutton" ><td colspan="42"><a href="#" class="add_tag_link btn btn-block btn-success fa fa-plus"> hinzufügen</a></td></tr>');
            } else {
                $collectionHold.append('<div class="row pvbutton"><div class="col-sm-12"><br /><a href="#" class="add_tag_link btn btn-block btn-success fa fa-plus"> hinzufügen</a></div></div>');
            }

        }
    });

    // count the current form inputs we have (e.g. 2), use that as the new
    // index when inserting a new item (e.g. 2)

    $collectionHolder.data('index', $collectionHolder.find(':input').length);

    $collectionHolder.each(function() {
        var $collectionSingleHolder = $(this);
        $collectionSingleHolder.find('.pvbutton a').on('click', function(e) {

            // prevent the link from creating a "#" on the URL
            e.preventDefault();

            // add a new tag form (see next code block)

            $newLinkLi = $collectionSingleHolder.find('.add_tag_link');

            addTagForm($collectionSingleHolder, $newLinkLi);
            addTagFormDeleteLink($newFormLi);
        });
    });
});

function addTagForm($collectionHolder, $newLinkLi) {
    // Get the data-prototype explained earlier
    var prototype = $collectionHolder.data('prototype');
    // get the new index
    var index = $collectionHolder.data('index');
    // Replace '__opt_prot__' in the prototype's HTML to
    // instead be a number based on how many items we have
    var newForm = prototype.replace(/__opt_prot__/g, index);
    // increase the index with one for the next item
    $collectionHolder.data('index', index + 1);
    // Display the form in the page in an li, before the "Add a tag" link li
    $collectionHolder.find('.pvbutton').before(newForm);
    $newFormLi = $collectionHolder.find('.col-del').last();
    start();
}

function addTagFormDeleteLink($tagFormLi) {
    var $removeFormA = $('<a href="#" class="btn btn-danger btn-sm fa fa-trash"></a>');
    $tagFormLi.append($removeFormA);
    $removeFormA.on('click', function(e) {
        // prevent the link from creating a "#" on the URL
        e.preventDefault();
        // remove the li for the tag form
        if($tagFormLi.parent().prop('tagName') == "TR"){
            $tagFormLi.parent().remove();
        } else {
            $tagFormLi.parent().remove();
        }
    });
}