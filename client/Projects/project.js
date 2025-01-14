$(document).ready(function () {

    filterProject("All");


    $(".category").click(function (e) {
        e.preventDefault();
        filterProject($(this).html())
    });

    function filterProject(category) {
        console.log(category);
        $.ajax({
            type: "post",
            url: "projectProcess.php",
            data: {
                getAllProjects_req: true
            },
            dataType: "json",
            success: function (response) {
                console.log(response);
                var filter = response.filter(function (data) {
                    if (category == "All") {
                        return true;
                    }
                    images += `<div class="carousel-item ${active}">
									<img src="../../employee/projects/${path}" class="d-block w-70 img-fluid img ">
									</div>`;
                    return data.category == category;
                })
                let content = ``;
                $.each(filter, function (indexInArray, data) {
                    console.log(filter);
                    let images = ``;
                    $.each(data.image, function (indexInArray, path) {
                        let active = '';
                        if (indexInArray == 0) {
                            active = "active";
                        }
                        images += `<div class="carousel-item ${active}">
                                        <img src="../../${path}" class="d-block w-70 img-fluid img ">
                                        </div>`;
                    });
                    content += `
                    <div class="col">
                            <div class="card">
    
                                <div id="carouselExampleInterval${indexInArray}" class="carousel slide">
                                    <div class="carousel-inner">
                                        ${images}
                                    </div>
                                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval${indexInArray}" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Previous</span>
                                    </button>
                                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval${indexInArray}" data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Next</span>
                                    </button>
                                </div>
                                <div class="card-body">
                                <p class=
                                    <p class="card-text">${data.description}</p> 
                                    <i class="far fa-heart react" data-id="${data.id}"></i> <span> ${data.reaction}</span>
                                </div>
                            </div>
                        </div>
                     `;
                    //  ${(data.react == 'like') ? "fas":"far"}
                });
                $("#materials").html(content);

                $('.react').click(function (e) { // dito yung dpat mag cchange to solid
                    e.preventDefault();
                    let postId = $(this).attr("data-id");
                    console.log(postId);
                    $.ajax({
                        type: "post",
                        url: "projectProcess.php",
                        data: {
                            setPostReaction: true, projectId: postId
                        },
                        dataType: "json",
                        success: function (response) {
                            
                            $(this).removeClass("far");
                            $(this).addClass("fas");
                        }
                    });


                });

            },
            error: function (response) {
                console.error(response.responseText);
            }
        });
    }

});