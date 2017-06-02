var AntevenioApp = (function() {
    var answers = {};
    var counter = 0;
    var mainUrl = '/antevenio/index.php';

    var addEventToAnswer = function(answerHtml) {
        answerHtml.addEventListener('click', function() {
            var answer = {};
            var element = this;
            var nodes   = element.childNodes;

            for (var index in nodes) {
                if ('IMG' === nodes[index].tagName) {
                    var imageSource = getImageSrc(nodes[index]);
                    answer.image = imageSource;
                }

                if ('DIV' === nodes[index].tagName && 'answer-info' === nodes[index].getAttribute('class')) {
                    if (undefined === nodes[index].childNodes) {
                        continue;
                    }

                    answer.title = nodes[index].childNodes[0].innerHTML;
                    answer.description = nodes[index].childNodes[1].innerHTML;
                }
            }

            if (isAnswerMarked(answer.image)) {
                unMarkedAnswer(element);
                removeAnswer(answer.image);
                counter--;
            } else {
                if (counter < 7) {
                    counter++;
                    answers[answer.image] = answer;
                    markedAnswer(element, counter);
                } else {
                    console.log('You only can mark 7 answers.');
                }
            }
        });
    };

    var getAnswers = function() {
        return [{
                'image' : 'viajero_0025',
                'title' : 'Xilitla',
                'description' : 'San Luis Potosí',
            },
            {
                'image' : 'viajero_0026',
                'title' : 'Mazatlan',
                'description' : 'Sinaloa',
            },
            {
                'image' : 'viajero_0027',
                'title' : 'Bacalar',
                'description' : 'Quintana Roo',
            },
            {
                'image' : 'viajero_0029',
                'title' : 'Barrancas del Cobre',
                'description' : 'Chihuahua',
            },
            {
                'image' : 'viajero_0028',
                'title' : 'Boca de Túnel',
                'description' : 'Aguascalientes',
            },
            {
                'image' : 'viajero_0024',
                'title' : 'Calakmul',
                'description' : 'Campeche',
            },
            {
                'image' : 'viajero_0023',
                'title' : 'Camécuaro',
                'description' : 'Michoacán',
            },
            {
                'image' : 'viajero_0022',
                'title' : 'Cascadas Aconco',
                'description' : 'Puebla',
            },
            {
                'image' : 'viajero_0021',
                'title' : 'Cenote Ik-Kil',
                'description' : 'Yucatán',
            },
            {
                'image' : 'viajero_0020',
                'title' : 'Manzanillo',
                'description' : 'Colima',
            },
            {
                'image' : 'viajero_0019',
                'title' : 'Costa Esmeralda',
                'description' : 'Veracruz',
            },
            {
                'image' : 'viajero_0018',
                'title' : '4 Ciénegas',
                'description' : 'Coahulia',
            },
            {
                'image' : 'viajero_0017',
                'title' : 'Islas Espíritu Santo',
                'description' : 'Baja California Sur',
            },
            {
                'image' : 'viajero_0016',
                'title' : 'Hierve agua',
                'description' : 'Oaxaca',
            },
            {
                'image' : 'viajero_0015',
                'title' : 'Las Estacas',
                'description' : 'Morelos',
            },
            {
                'image' : 'viajero_0014',
                'title' : 'Mapimi',
                'description' : 'Durango',
            },
            {
                'image' : 'viajero_0013',
                'title' : 'Santuario de las Luciernagas',
                'description' : 'Tlaxcala',
            },
            {
                'image' : 'viajero_0012',
                'title' : 'Islas Marietas',
                'description' : 'Nayarit',
            },
            {
                'image' : 'viajero_0011',
                'title' : 'Matacanes',
                'description' : 'Nuevo León',
            },
            {
                'image' : 'viajero_0010',
                'title' : 'Nevado de Toluca',
                'description' : 'Estado de México',
            },
            {
                'image' : 'viajero_0009',
                'title' : 'Pantanos de Centla',
                'description' : 'Tabasco',
            },
            {
                'image' : 'viajero_0008',
                'title' : 'Desierto el Pinacate',
                'description' : 'Sonora',
            },
            {
                'image' : 'viajero_0007',
                'title' : 'Puente de Dios',
                'description' : 'Quéretaro',
            },
            {
                'image' : 'viajero_0006',
                'title' : 'Biosfera el cielo Tamaulipas',
                'description' : 'Tamaulipas',
            },
            {
                'image' : 'viajero_0005',
                'title' : 'Parque Nacional San Pedro Martir',
                'description' : 'Baja California',
            },
            {
                'image' : 'viajero_0004',
                'title' : 'La bufa',
                'description' : 'Zacatecas',
            },
            {
                'image' : 'viajero_0003',
                'title' : 'Taxco',
                'description' : 'Guerrero',
            },
            {
                'image' : 'viajero_0002',
                'title' : 'Tolantongo',
                'description' : 'Hidalgo',
            },
            {
                'image' : 'viajero_0001',
                'title' : 'Cascada las nubes',
                'description' : 'Chiapas',
            },
            {
                'image' : 'viajero_0000',
                'title' : 'Tequila',
                'description' : 'Jalisco',
            },
            {
                'image' : 'san_miguel_de_allende',
                'title' : 'San Miguel de Allende',
                'description' : 'Guanajuato'
            },
            {
                'image' : 'ciudad_de_mexico',
                'title' : 'Bellas Artes',
                'description' : 'Ciudad de México'
            },
        ];
    };

    var addEventToAnswers = function() {
        var answersHtml = document.getElementsByClassName('answer');

        for (var i = 0; i < answersHtml.length; i++) {
            addEventToAnswer(answersHtml[i]);
        }
    };

    var getImageSrc = function(imgElement) {
        var src = imgElement.getAttribute('src');

        return src.substring((src.lastIndexOf('/') + 1), src.indexOf('.jpg'));
    };

    var isAnswerMarked = function(answer) {
        return !(undefined === answers[answer]);
    };

    var markedAnswer = function(answer, index) {
        var answered = document.createElement('div');
        answered.setAttribute('class', 'answered');

        var span = document.createElement('span');
        span.innerHTML = index;

        answered.appendChild(span);
        answer.insertBefore(answered, answer.childNodes[0]);
    };

    var unMarkedAnswer = function(answer) {
        answer.removeChild(answer.childNodes[0]);
    };

    var renderAnswers = function() {
        var answersList = getAnswers();
        var html = '';

        for (var index in answersList) {
            var answer = answersList[index];
            html += '<div class="answer" data-answer-id="' + answer['image'] + '">' +
                        '<img src="/antevenio/public/images/' + answer['image'] + '.jpg" class="answer-img"/>' +
                        '<div class="answer-info">' +
                            '<h5 class="answer-title">' + answer['title'] + '</h5>' +
                            '<p class="answer-description">' + answer['description'] + '</p>' +
                        '</div>' +
                     '</div>';
        }

        document.getElementById('answers').innerHTML = html;
    };

    var removeAnswer = function(answer) {
        delete answers[answer];
    };

    var processForm = function() {
        var form = document.getElementById('form-profile');
        form.addEventListener('submit', function(e) {
            e.preventDefault();

            if (Object.keys(answers).length !== 7) {
                return alert('Completa las respuestas.');
            }

            var name   = document.getElementById('name');
            var email  = document.getElementById('email');
            var day    = document.getElementById('day');
            var month  = document.getElementById('month');
            var year   = document.getElementById('year');
            var gender = document.getElementById('gender');

            if ('' === name.value.trim() || '' === email.value.trim() || ('' === day.value.trim() && '' === month.value.trim() && year.value.trim()) || '' === gender.value.trim()) {
                return alert('Por favor completa todos los campos');
            }

            sendData({
                'name' : name.value,
                'email': email.value,
                'day': day.value,
                'month': month.value,
                'year': year.value,
                'gender': gender.value,
                'answers' : answers
            });
        });
    };

    var sendData = function(data) {
        var xhttp = new XMLHttpRequest();
        xhttp.open('POST', mainUrl + '/persist');
        xhttp.setRequestHeader('Content-Type', 'application/json;charset=UTF-8');
        xhttp.onreadystatechange = function() {
            if (200 === xhttp.status) {
                localStorage.setItem('answers', JSON.stringify(answers));
                window.location.href = mainUrl + '/thanks';
            }
        }
        xhttp.send(JSON.stringify(data));
    };

    var thanks = function() {
        var answers = JSON.parse(localStorage.getItem('answers'));

        var html = '<div id="voted-answers">';

        for (var index in answers) {
            var answer = answers[index];

            html += '<div class="voted-answer">' +
                        '<p class="voted-answer-description"> ' + answer['description'] + ' </p>' +
                        '<img src="/antevenio/public/images/' + answer['image'] + '.jpg" class="voted-answer-img"/>' +
                        '<h4 class="voted-answer-title"> ' + answer['title'] +' </h4>' +
                    '</div>';
        }

        localStorage.removeItem('answers');
        html += '</div';

        document.getElementById('thanks').innerHTML = html;
    };

    return {
        init: function() {
            renderAnswers();
            addEventToAnswers();
            processForm();
        },
        thanks: thanks,
    };
})();


var Lightbox = (function() {
    return {
        init: function() {
            var opacity = 1;
            var interval = setInterval(function() {
                opacity -= .05;
                lightbox.style.opacity = opacity;

                if (opacity < 0) {
                    lightbox.style.display = 'none';
                    clearInterval(interval);
                }
            }, 150);
        }
    }
})();