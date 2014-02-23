TEX_FILES=symfony-cakephp.tex \
          symfony-cakephp-polycopie.tex
          
TEX_INCLUDES=contenu.tex \
	     introduction.tex \
	     symfony.tex \
	     img/fonctionnement.png \
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

