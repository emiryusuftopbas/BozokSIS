<div class="column is-9">
    <section class="hero is-info welcome is-small">
        <div class="hero-body">
            <div class="container">
                <h1 class="title">
                Hello, <?php echo mb_strtoupper($userFullName); ?>
                </h1>
                <h2 class="subtitle">
                I hope you are having a great day!
                </h2>
            </div>
        </div>
    </section>
    <section class="info-tiles">
        <div class="tile is-ancestor has-text-centered">
            <div class="tile is-parent">
                <article class="tile is-child box">
                    <p class="title"><?php echo $statistics["numberOfStudents"] ?></p>
                    <p class="subtitle">Students</p>
                </article>
            </div>
            <div class="tile is-parent">
                <article class="tile is-child box">
                    <p class="title"><?php echo $statistics["numberOfAcademicians"] ?></p>
                    <p class="subtitle">Academicians</p>
                </article>
            </div>
            <div class="tile is-parent">
                <article class="tile is-child box">
                    <p class="title"><?php echo $statistics["numberOfLessons"] ?></p>
                    <p class="subtitle">Lessons</p>
                </article>
            </div>
            <div class="tile is-parent">
                <article class="tile is-child box">
                    <p class="title"><?php echo $statistics["numberOfFaculties"] ?></p>
                    <p class="subtitle">Faculties</p>
                </article>
            </div>
            <div class="tile is-parent">
                <article class="tile is-child box">
                    <p class="title"><?php echo $statistics["numberOfDepartments"] ?></p>
                    <p class="subtitle">Departments</p>
                </article>
            </div>
        </div>
    </section>
</div>