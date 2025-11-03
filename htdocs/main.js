const { app, BrowserWindow } = require('electron');
const path = require('path');

function createWindow () {
  const win = new BrowserWindow({
    width: 1280,
    height: 800,
    webPreferences: {
      preload: path.join(__dirname, 'preload.js')
    }
  });

  win.loadFile('index.html');
}

app.whenReady().then(() => {
  createWindow();
  app.on('activate', () => {
    if (BrowserWindow.getAllWindows().length === 0) createWindow();
  });
});

app.on('window-all-closed', () => {
  if (process.platform !== 'darwin') app.quit();
});

function scrollToSecond() {
  const seta = document.querySelector(".arrow-down");
  seta.classList.add("clicked");

  setTimeout(() => {
    document.querySelector("#second-block").scrollIntoView({ behavior: 'smooth' });
    seta.classList.remove("clicked");
  }, 150);
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