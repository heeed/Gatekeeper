#!/usr/bin/env python

import pygame
from pygame.locals import QUIT, KEYDOWN
import sys
import os
import re

URL_RE = re.compile(r'((mailto\:|(news|(ht|f)tp(s?))\://){1}\S+)')

import opencv
from opencv import highgui

import zbar

def get_image(camera):
    im = highgui.cvQueryFrame(camera)
    return opencv.adaptors.Ipl2PIL(im) 

def get_code(img):
    w, h = img.size
    zimg = zbar.Image(w, h, 'Y800', img.convert('L').tostring())

    proc = zbar.ImageScanner()

    if proc.scan(zimg):
        [sym] = list(zimg.symbols)
        return sym.data

if __name__ == '__main__':
    camera = highgui.cvCreateCameraCapture(0)

    fps = 25
    pygame.init()
    window = pygame.display.set_mode((640,480))
    pygame.display.set_caption("Get QR Code")
    screen = pygame.display.get_surface()

    while True:
        events = pygame.event.get()
        for event in events:
            if event.type == QUIT or event.type == KEYDOWN:
                sys.exit(0)
       
        im = get_image(camera)
        code = get_code(im)
        if code:
            
          
            if code:
                
               os.system("beep")
               os.system("echo")
               print code
           
            break

        pg_img = pygame.image.frombuffer(im.tostring(), im.size, im.mode)
        screen.blit(pg_img, (0,0))
        pygame.display.flip()
        pygame.time.delay(int(1000 * 1.0/fps))
