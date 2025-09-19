console.log("App iniciado com sucesso.");

const secondBlock = document.querySelector("#second-block");

if (secondBlock) {
  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add("reveal");
        observer.unobserve(entry.target);
      }
    });
  }, { threshold: 0.5 });

  observer.observe(secondBlock);
}

function atualizarCursos() {
  const universidade = document.getElementById("instituicao").value;
  const cursoSelect = document.getElementById("curso");
  cursoSelect.innerHTML = "";

  let cursos = [];

  if (universidade === "utfpr") {
    cursos = [
      "Arquitetura e Urbanismo",
      "Análise e Desenvolvimento de Sistemas",
      "Design Gráfico",
      "Engenharia da Computação",
      "Engenharia Elétrica",
      "Engenharia Civil",
      "Sistemas de Informação"
    ];
  } else if (universidade === "ufrj") {
    cursos = [
      "Ciências Econômicas",
      "Engenharia da Computação e Informação",
      "Engenharia de Produção",
      "Engenharia Química",
      "Física",
      "Medicina",
      "Odontologia"
    ];
  } else if (universidade === "usp") {
    cursos = [
      "Audiovisual",
      "Ciências Biomédicas",
      "Direito",
      "Jornalismo",
      "Medicina",
      "Psicologia",
      "Relações Internacionais"
    ];
  } else if (universidade === "unifesp") {
    cursos = [
      "Administração",
      "Biomedicina",
      "Ciências Sociais",
      "Filosofia",
      "Geografia",
      "História",
      "Letras",
      "Nutrição",
      "Pedagogia"
    ];
  }

  if (cursos.length === 0) {
    const opt = document.createElement("option");
    opt.text = "-- Escolha a universidade primeiro --";
    cursoSelect.add(opt);
    return;
  }

  cursos.forEach(curso => {
    const opt = document.createElement("option");
    opt.value = curso.toLowerCase().replace(/\s+/g, "-");
    opt.text = curso;
    cursoSelect.add(opt);
  });
  
}
function mostrarEtapa(proximaId) {
  const proxima = document.getElementById(proximaId);
  if (proxima && proxima.style.display === "none") {
    proxima.style.display = "block";
    atualizarCursos();
    proxima.classList.add("fade-in");    
  }
}

function animateAndRedirect() {
  document.body.classList.add('fade-out');
  setTimeout(() => {
    window.location.href = "criar-plano.html";
  }, 150);
}

function animateAndRedirect2() {
  document.body.classList.add('fade-out');
  setTimeout(() => {
    window.location.href = "plano.html";
  }, 150);
}
