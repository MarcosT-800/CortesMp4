<?php

$ffmpegPath = "C:/Users/marcos.junior/Downloads/ffmpeg/ffmpeg/bin/ffmpeg";

// Função para dividir o vídeo em partes de 10 minutos
function splitVideo($videoPath, $outputDirectory, $ffmpegPath)
{
    // Verifica se o arquivo de vídeo é acessível
    if (!is_readable($videoPath)) {
        echo "O arquivo de vídeo não pôde ser acessado.";
        return;
    }

    // Define a duração do segmento em segundos (10 minutos)
    $segmentDuration = 10 * 60;

    // Define o comando FFmpeg para dividir o vídeo
    $command = "$ffmpegPath -i \"$videoPath\" -c copy -map 0 -segment_time $segmentDuration -f segment \"$outputDirectory/part-%03d.mp4\"";

    // Abre um processo para executar o comando FFmpeg
    $process = proc_open($command, [], $pipes);

    // Aguarda o processo FFmpeg terminar
    $returnValue = proc_close($process);

    // Verifica se a execução foi bem-sucedida
    if ($returnValue === 0) {
        echo "Vídeo dividido com sucesso!";
    } else {
        echo "Erro ao dividir o vídeo.";
    }
}

// Caminho para o vídeo de entrada
$videoPath = "C:/Users/marcos.junior/Downloads/video.mp4";

// Diretório de saída para os segmentos de vídeo
$outputDirectory = "C:/Users/marcos.junior/Downloads/saida";

// Chama a função para dividir o vídeo
splitVideo($videoPath, $outputDirectory, $ffmpegPath);
?>
