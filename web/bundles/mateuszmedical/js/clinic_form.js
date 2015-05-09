

jQuery(document).ready(function() {

    var $collectionHolder = $('ul.patients');

    // add a delete link to all of the existing tag form li elements
    $collectionHolder.find('li').each(function() {
        addPatientFormDeleteLink($(this));
    });

    // setup an "add a tag" link
    var $addTagLink = $('<a href="#" class="add_patient_link">Dodaj pacjenta</a>');
    var $newLinkLi = $('<li></li>').append($addTagLink);

    // add the "add a tag" anchor and li to the tags ul
    $collectionHolder.append($newLinkLi);

    // count the current form inputs we have (e.g. 2), use that as the new
    // index when inserting a new item (e.g. 2)
    $collectionHolder.data('index', $collectionHolder.find(':input').length);

    $addTagLink.on('click', function(e) {
        // prevent the link from creating a "#" on the URL
        e.preventDefault();

        // add a new tag form (see next code block)
        addPatientForm($collectionHolder, $newLinkLi);
    });

    function addPatientForm($collectionHolder, $newLinkLi) {
        // Get the data-prototype explained earlier
        var prototype = $collectionHolder.data('prototype');

        // get the new index
        var index = $collectionHolder.data('index');

        // Replace '__name__' in the prototype's HTML to
        // instead be a number based on how many items we have
        var newForm = prototype.replace(/__name__/g, index);

        // increase the index with one for the next item
        $collectionHolder.data('index', index + 1);

        // Display the form in the page in an li, before the "Add a tag" link li
        var $newFormLi = $('<li></li>').append(newForm);
        $newLinkLi.before($newFormLi);


        addPatientFormDeleteLink($newFormLi);
    }

    function addPatientFormDeleteLink($tagFormLi) {
        var $removeFormA = $('<a href="#">Usuń pacjenta</a>');
        $tagFormLi.append($removeFormA);

        $removeFormA.on('click', function(e) {
            // prevent the link from creating a "#" on the URL
            e.preventDefault();

            // remove the li for the tag form
            $tagFormLi.remove();
        });
    }

});