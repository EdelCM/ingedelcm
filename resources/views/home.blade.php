@extends('layouts.app')

@section('title', 'Portafolio de Luis Eduardo Castillo')

@section('content')
<header>
  <h1>Ing. Luis Eduardo Castillo Mosquera</h1>
  <p>Ingeniero de Sistemas | Experto en Servicios TI | Formador con Impacto Social</p>
</header>

<section id="contacto">
  <h2>📞 Contacto</h2>
  <p><strong>Teléfono de contacto:</strong> 315 440 5619 </p>
  <p><strong>Email:</strong> <a href="mailto:eduardocastillomosquera@gmail.com">eduardocastillomosquera@gmail.com</a></p>

  <div class="redes-sociales">
    <a href="#" target="_blank"><i class="fab fa-facebook-square"></i> Facebook</a>
    <a href="#" target="_blank"><i class="fab fa-tiktok"></i> TikTok</a>
    <a href="#" target="_blank"><i class="fab fa-instagram"></i> Instagram</a>
    <a href="#" target="_blank"><i class="fab fa-youtube"></i> YouTube</a>
  </div>
</section>

<section id="sobremi">
  <h2>👨‍💼 Sobre Mí</h2>
    <p>Soy un ingeniero de sistemas con más de 5 años de experiencia liderando proyectos tecnológicos, desarrollo de software y servicios de infraestructura TI. Me especializo en soluciones eficientes que mejoran procesos, integran nuevas tecnologías y generan valor real.</p>
    <p>Mi experiencia incluye desarrollo en PHP (Yii2), HTML, JavaScript, jQuery, manejo de bases de datos, pruebas QA y metodologías ágiles como Scrum. He liderado soporte técnico en empresas de nivel nacional, destacándome por reducir tiempos, mejorar flujos y garantizar calidad en cada entrega.</p>
    <p>Además, tengo un fuerte compromiso social: formo personas de comunidades vulnerables en habilidades tecnológicas, brindando oportunidades de crecimiento y empleabilidad a jóvenes y adultos mayores a través del acceso a herramientas digitales.</p>
</section>

<section id="mision-vision">
  <h2>🎯 Misión</h2>
    <p>Brindar soluciones tecnológicas que impulsen el desarrollo organizacional y social, combinando innovación, eficiencia y compromiso ético. Mi misión es empoderar a personas y comunidades a través de la tecnología y la formación, fomentando un crecimiento inclusivo y sostenible.</p>

    <h2>🚀 Visión</h2>
    <p>Ser un referente en Colombia en desarrollo tecnológico con impacto social, creando herramientas accesibles, innovadoras y orientadas al bienestar colectivo. Aspiro a liderar iniciativas que transformen vidas, reduciendo brechas digitales y fortaleciendo el ecosistema tecnológico desde las bases.</p>
</section>

<section id="proyectos">
  <h2>💻 Proyectos Destacados</h2>
  <p>Explora los proyectos gratuitos que he desarrollado:</p>
  <ul>
    <li>
      <a href="{{ route('bingo') }}" target="_blank">
        <strong>Generador de </strong> – cartones de Bingo
    </a>
    </li>
    <li>
      <a href="#" target="_blank">
        🧩 <strong>Always Win</strong> – Juego de azar con enfoque social
      </a>
    </li>
  </ul>
  <button onclick="alert('Gracias por visitarme')"> 💬 Haz clic para contactarme </button>
</section>

<footer>
  <p>© 2025 Luis Eduardo Castillo | Todos los derechos reservados</p>
</footer>
@endsection
