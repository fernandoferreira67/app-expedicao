<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Carriers') }}
        </h2>
    </x-slot>


    <div class="flex items-start justify-center min-h-screen p-2 bg-gray-100">

      <div class="container max-w-screen-lg mx-auto">


    <style>
        .canvas-container {
          border: 2px solid #000;
          position: relative;
          width: 100%;
          max-width: 500px;
          height: 300px;
          margin: 0 auto;
        }

        canvas {
          width: 100%;
          height: 100%;
          border: none;
        }

        .buttons {
          text-align: center;
          margin-top: 10px;
        }

        button {
          padding: 10px 20px;
          margin: 5px;
          font-size: 16px;
        }
      </style>

<div x-data="signaturePad()" class="signature-pad">

  <!-- Canvas onde a assinatura será desenhada -->
  <div class="canvas-container">
    <canvas x-ref="canvas" id="canvas"></canvas>
  </div>

  <div class="buttons">
    <button @click="clearCanvas()">Limpar</button>
    <button @click="saveSignature()">Salvar</button>
  </div>

  <!-- Exibir a assinatura salva -->
  <div x-show="savedSignature" class="saved-signature">
    <h3>Assinatura Salva:</h3>
    <img :src="savedSignature" alt="Assinatura salva">
  </div>
</div>

<script>
  function signaturePad() {
    return {
      savedSignature: null,
      canvas: null,
      ctx: null,
      isDrawing: false,
      lastX: 0,
      lastY: 0,

      init() {
        // Configuração do canvas
        ///this.canvas = this.$refs.canvas;
        this.canvas = document.getElementById("canvas");
        this.ctx = this.canvas.getContext("2d");

        // Configurações iniciais de desenho
        this.ctx.lineWidth = 3;
        this.ctx.lineJoin = "round";
        this.ctx.lineCap = "round";
        this.ctx.strokeStyle = "#000";

        // Ajuste do tamanho do canvas
        this.canvas.width = this.canvas.offsetWidth;
        this.canvas.height = this.canvas.offsetHeight;

        // Eventos de mouse e toque
        this.canvas.addEventListener("mousedown", this.startDrawing);
        this.canvas.addEventListener("mousemove", this.draw);
        this.canvas.addEventListener("mouseup", this.stopDrawing);
        this.canvas.addEventListener("mouseleave", this.stopDrawing);

        // Para toque
        this.canvas.addEventListener("touchstart", this.startDrawing);
        this.canvas.addEventListener("touchmove", this.draw);
        this.canvas.addEventListener("touchend", this.stopDrawing);
      },

      startDrawing(event) {
        event.preventDefault();
        this.isDrawing = true;
        this.lastX = event.clientX || event.touches[0].clientX;
        this.lastY = event.clientY || event.touches[0].clientY;
      },

      draw(event) {
        console.log(event)
        if (!this.isDrawing) return;
        event.preventDefault();

        const x = event.clientX || event.touches[0].clientX;
        const y = event.clientY || event.touches[0].clientY;

        this.ctx.beginPath();
        this.ctx.moveTo(this.lastX, this.lastY);
        this.ctx.lineTo(x, y);
        this.ctx.stroke();

        this.lastX = x;
        this.lastY = y;
      },

      stopDrawing(event) {
        this.isDrawing = false;
      },

      clearCanvas() {
        this.ctx.clearRect(0, 0, this.canvas.width, this.canvas.height);
        this.savedSignature = null;
      },

      saveSignature() {
        this.savedSignature = this.canvas.toDataURL("image/png");
      }
    };
  }
</script>

      </div>
    </div>
</x-app-layout>
