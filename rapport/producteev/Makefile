TEX_FILES=producteev.tex \
          producteev-polycopie.tex \
          presentation-producteev.tex
          
TEX_INCLUDES=contenu.tex \
	     introduction.tex \
	     utilisation.tex \
	     taches.tex \
	     activites.tex \
	     img/interface.png \
	     img/producteev.png \
             $(NULL)

PDF_FILES=$(TEX_FILES:%.tex=%.pdf)

all: $(PDF_FILES)

$(PDF_FILES): %.pdf: %.tex
	pdflatex $<
	pdflatex $<

$(TEX_FILES): $(TEX_INCLUDES)
	@touch $*.tex

clean:
	rm -f *.out *.nav *.toc *.aux *.log *.snm *.vrb *.dvi *.ps

.PHONY: all clean

