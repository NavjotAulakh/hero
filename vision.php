<?php

// [START vision_fulltext_detection]
namespace Google\Cloud\Samples\Vision;
use Google\Cloud\Vision\V1\ImageAnnotatorClient;
$path = 'doc.jpg'
function detect_document_text($path)
{
    $imageAnnotator = new ImageAnnotatorClient();
    # annotate the image
    $image = file_get_contents($path);
    $response = $imageAnnotator->documentTextDetection($image);
    $annotation = $response->getFullTextAnnotation();
    # print out detailed and structured information about document text
    if ($annotation) {
        foreach ($annotation->getPages() as $page) {
            foreach ($page->getBlocks() as $block) {
                $block_text = '';
                foreach ($block->getParagraphs() as $paragraph) {
                    foreach ($paragraph->getWords() as $word) {
                        foreach ($word->getSymbols() as $symbol) {
                            $block_text .= $symbol->getText();
                        }
                        $block_text .= ' ';
                    }
                    $block_text .= "\n";
                }
                printf('Block content: %s', $block_text);
                printf('Block confidence: %f' . PHP_EOL,
                    $block->getConfidence());
                # get bounds
                $vertices = $block->getBoundingBox()->getVertices();
                $bounds = [];
                foreach ($vertices as $vertex) {
                    $bounds[] = sprintf('(%d,%d)', $vertex->getX(),
                        $vertex->getY());
                }
                print('Bounds: ' . join(', ',$bounds) . PHP_EOL);
                print(PHP_EOL);
            }
        }
    } else {
        print('No text found' . PHP_EOL);
    }
    $imageAnnotator->close();
}
// [END vision_fulltext_detection]
