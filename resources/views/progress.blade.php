<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Progress</title>

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Styles -->
</head>

<body class="antialiased">
    @component('components.header')
    @endcomponent
    <div class="container mt-8 id="app">
        <h2>@{{ progress }}</h2>
        <hr>
        <h5>@{{ pageTitle }}</h5>
        <hr>
        <div class="progress">
            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="60"
                aria-valuemin="0" aria-valuemax="100" style="width: 40%;">
                40%
            </div>
        </div>
    </div>

    <!-- development version -->
    {{--  <script src="https://unpkg.com/vue@3.2.22/dist/vue.global.prod.js"></script> --}}
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script type="text/javascript">
        const app = {
            data() {
                return {
                    progress: 'Welcome to progress page',
                    pageTitle: 'Progress Of Uploads',
                    progressPercentage: 0,
                    params: {
                        id: null
                    }
                }
            },
            methods: {
                checkIfIdPresent() {
                    const urlSearchParams = new urlSearchParams(window.locarion.search);
                    const params = Object.fromEntries(urlSearchParams.entries());

                    // console.log(params);
                    if (params.id) {
                        this.params.id = params.id;
                    }
                },
                getUploadProgress() {
                    let self = this;
                    self.checkIfIdPresent();

                    // Get progress data.
                    let progressResponse = setInterval(() => {
                        axios.get('/progress/data', {
                            params: {
                                id: self.params.id ? self.params.id :
                                "{{ session()->get('lastBatchId') }}",
                            }
                        }).then(function(response) {
                            console.log(response.data);
                        })
                    }, 1000);
                }
            },
            created() {
                this.checkIfIdPresent();
            }
        }

        Vue.createApp(app).mount("#app")
    </script>



</body>

</html>
